<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity_request;
use App\Models\ActivityLog_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLog_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ActivityLog_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Activity_request $request)
    {
        $activity = ActivityLog_model::create($request->validated());

        // return response()->json([$activity]);

        return $activity;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = ActivityLog_model::findOrFail($id);

        return $activity;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Activity_request $request, string $id)
    {
        $validated = $request->validated();

        $activity = ActivityLog_model::findOrFail($id)->update($validated);

        return $activity;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = ActivityLog_model::findOrFail($id);

        $activity->delete();

        return $activity;
    }

    public function userActivity()
    {
        $userActivities = DB::table('activity_log')
            ->select(
                'product.prod_name',
                'activity_log.act_id',
                'activity_log.type',
                'activity_log.prod_id',
                'activity_log.account_id',
                'activity_log.created_at',
                'activity_log.updated_at',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS user_name"),

            )
            ->leftJoin('product', 'activity_log.prod_id', '=', 'product.prod_id')
            ->leftJoin('users', 'activity_log.account_id', '=', 'users.account_id')


            ->orderBy('activity_log.created_at', 'desc')
            ->get();

        return $userActivities;
    }

    // public function userActivityWithProductAndUser()
    // {
    //     $userActivities = DB::table('activity_log')
    //         ->select(
    //             'activity_log.*',
    //             'products.prod_name',
    //             'users.first_name',
    //             'users.last_name'
    //         )
    //         ->leftJoin('products', 'activity_log.prod_id', '=', 'products.prod_id')
    //         ->leftJoin('users', 'activity_log.account_id', '=', 'users.account_id')
    //         ->orderBy('activity_log.created_at', 'desc')
    //         ->get();

    //     return $userActivities;
    // }
}
