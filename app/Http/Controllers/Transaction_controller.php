<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction_request;
use App\Models\Transaction_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaction_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaction_model::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Transaction_request $request)
    {
        $transaction = Transaction_model::create($request->validated());

        return $transaction;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction_model::findOrFail($id);

        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Transaction_request $request, string $id)
    {
        $validated = $request->validated();

        $transaction = Transaction_model::findOrFail($id)->update($validated);

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction_model::findOrFail($id);
        $transaction->delete();

        return $transaction;
    }

    public function userTrans()
    {
        $response = DB::table('transactions')
            ->select('transactions.*', 'users.first_name', 'users.last_name', 'users.account_id')
            ->join('users', 'transactions.account_id', '=', 'users.account_id')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return $response;
    }

    public function transSort()
    {
        $totalIncome = DB::table('transactions')
            ->selectRaw('SUM(income) as total_income')
            ->get();

        return $totalIncome;
    }

    public function transBalance()
    {
        $currentBalance = DB::table('transactions')
            ->orderByDesc('created_at') // You can change 'created_at' to any column you use for ordering
            ->limit(1)
            ->selectRaw('update_balance as CurrentBalance')
            // ->value('update_balance')
            ->get();

        return $currentBalance;
    }
}
