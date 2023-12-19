<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category_request;
use App\Models\Category_model;
use Illuminate\Http\Request;

class Category_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Category_request $request)
    {
        $category = Category_model::create($request->validated());

        // return response()->json([$category]);

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category_model::findOrFail($id);

        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category_request $request, string $id)
    {
        $validated = $request->validated();

        $category = Category_model::findOrFail($id)->update($validated);

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category_model::findOrFail($id);

        $category->delete();

        return $category;
    }
}
