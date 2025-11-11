<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['workshops'=>Workshop::all()->load('customer')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'name' => ['string','required'],
            'location' => ['string','required'],
            'customer_id'=>['required','integer']
        ]);
        DB::beginTransaction();
        $workshop = Workshop::create([
            'name' => $data['name'],
            'location' => $data['location'],
            'customer_id' => $data['customer_id'],
        ]);
        $tresure = $workshop->tresure()->create([
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

        return response()->json(['workshop'=>Workshop::findOrFail($id)->load('customer'),'customers'=>Customer::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','required'],
            'location' => ['string','required'],
            'customer_id'=>['required','integer']
        ]);

        $workshop = Workshop::findOrFail($id);
        $workshop->update($data);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workshop = Workshop::findOrFail($id);
        $workshop->delete();
        return response()->json(['workshop'=>Workshop::all()]);
    }
}
