<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['admin'=>Admin::all()->load('user','type')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:100','required'],
            'address' => ['string','max:100','required'],
            'department' => ['string','max:100','required'],
            'email' => ['email','required'],
            'password' => ['required'],
            'admintype_id'=>['required','integer']
        ]);
        DB::beginTransaction();
        $admin = Admin::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'department' => $data['department'],
            'admintype_id' => $data['admintype_id'],
        ]);
        $admin->user()->create([
            'email' =>$data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $tresure = $admin->tresure()->create([
            'name' => 'أساسي',
            'active' => true,
        ]);
        $tresure->tresurefunds()->create([
            'name'=>'أساسي',
            'desc'=>'.',
        ]);
        DB::commit();
        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['admin'=>Admin::findOrFail($id)->load('user'),'admintypes'=>AdminType::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
            'phone' => ['string','max:100',],
            'admin_level' => ['string','max:100',],
            'department' => ['string','max:100',],
            'email' => ['email'],
            'password' => ['min:8'],
        ]);
        DB::beginTransaction();
        $admin = Admin::findOrFail($id);
        $admin->update($data);
        $admin->user()->update([
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
        $admin = Admin::findOrFail($id);
        $admin->user()->delete();
        $admin->tresure()->delete();
        $admin->delete();
        DB::commit();
        return response()->json(['admin'=>Admin::all()->load('user')]);
    }
}
