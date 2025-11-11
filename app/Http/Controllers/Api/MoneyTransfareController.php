<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MoneyTranfare;
use Illuminate\Http\Request;

class MoneyTransfareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'tresurefund_id' => ['integer','required'],
        ]);
        $MoneyTranfare = MoneyTranfare::where('from_tresure_fund_id','=',$data['tresurefund_id'])->orWhere('to_tresure_fund_id','=',$data['tresurefund_id'])->get()->load('totresurefund','fromtresurefund');
        return response()->json(['moneytrans'=>$MoneyTranfare]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
