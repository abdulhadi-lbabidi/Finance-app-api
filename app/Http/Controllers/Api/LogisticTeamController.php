<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LogisticTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogisticTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['logisticteams' => LogisticTeam::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'max:100', 'required'],
            'phone' => ['string', 'max:100', 'required'],
            'address' => ['string', 'max:100', 'required'],
            'email' => ['email', 'required'],
            'password' => ['required'],
        ]);
        DB::beginTransaction();
        LogisticTeam::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
        DB::commit();
        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
