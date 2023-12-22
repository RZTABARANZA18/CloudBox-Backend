<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales_request;
use App\Models\Sales_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sales_controller extends Controller
{
    //**
    // * Display a listing of the resource.
    // */
    public function index()
    {
        return Sales_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Sales_request $request)
    {
        $product = Sales_model::create($request->validated());

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Sales_model::findOrFail($id);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Sales_request $request, string $id)
    {
        $validated = $request->validated();

        $product = Sales_model::findOrFail($id)->update($validated);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Sales_model::findOrFail($id);

        $product->delete();

        return $product;
    }

    // public function annualSales()
    // {
    //     $currentYear = date('Y');

    //     $totalSales = DB::table('sales')
    //         ->whereYear('created_at', $currentYear)
    //         ->sum('total_amount');

    //     return $totalSales;
    // }

    public function weeklySales()
    {
        $weeklySalesSum = Sales_model::select(
            // DB::raw("EXTRACT(YEAR FROM created_at) AS Year"),
            // DB::raw("EXTRACT(WEEK FROM created_at) AS Week"),
            DB::raw('SUM(quantity) AS Total_Quantity')
        )
            ->groupBy(DB::raw("EXTRACT(YEAR FROM created_at)"), DB::raw("EXTRACT(WEEK FROM created_at)"))
            ->get();

        return $weeklySalesSum;
    }

    public function annualSales($year)
    {
        $totalSales = DB::table('sales')
            ->whereYear('created_at', $year)
            ->sum('total_amount');

        return $totalSales;
    }
}
