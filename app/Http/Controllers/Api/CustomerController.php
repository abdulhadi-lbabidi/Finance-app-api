<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['customer'=>Customer::all()->load('user')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:100','required'],
            'phone' => ['string','max:100','required'],
            'address' => ['string','max:100','required'],
            'email' => ['email','required'],
            'password' => ['required'],

        ]);
        DB::beginTransaction();
        $customer = Customer::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
        $customer->user()->create([
            'email' =>$data['email'],
            'password' => bcrypt($data['password'])
        ]);

        DB::commit();
        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['customer'=>Customer::findOrFail($id)->load('user')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
            'phone' => ['string','max:100',],
            'address' => ['string','required'],
            'email' => ['email'],
            'password' => [],

        ]);
        DB::beginTransaction();
        $customer = Customer::findOrFail($id);
        $customer->update($data);
        $customer->user()->update([
            'email' =>$data['email'],
            'password' => $data['password']
        ]);

        DB::commit();
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        $customer = Customer::findOrFail($id);
        $customer->user()->delete();
        $customer->delete();
        DB::commit();
        return response()->json(['customer'=>Customer::all()->load('user')]);
    }
}
