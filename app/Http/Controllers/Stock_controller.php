<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock_request;
use App\Models\Stock_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Stock_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Stock_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Stock_request $request)
    {
        $stock = Stock_model::create($request->validated());

        return $stock;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = Stock_model::findOrFail($id);

        return $stock;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Stock_request $request, string $id)
    {
        $validated = $request->validated();

        $stock = Stock_model::findOrFail($id)->update($validated);

        return $stock;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock_model::findOrFail($id);

        $stock->delete();

        return $stock;
    }

    public function userStock()
    {
        $leftJoin = DB::table('stock')
            ->leftJoin('users', 'stock.account_id', '=', 'users.id')
            ->select('stock.*', 'users.*')
            ->get();

        return $leftJoin;
    }

    public function sumStock()
    {
        // Sum the 'stock' column for all products
        $totalQuantity = DB::table('stock')->sum('quantity');

        // Now, $overallStock contains the sum of the 'stock' column for all products
        return $totalQuantity;
    }
}
