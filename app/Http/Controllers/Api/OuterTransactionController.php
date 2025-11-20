<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OuterTransaction;
use Illuminate\Http\Request;

class OuterTransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $data = $request->validate([
      'tresurefund_id' => ['integer', 'required'],
    ]);
    $outerTrans = OuterTransaction::where('tresure_fund_id', '=', $data['tresurefund_id'])
      ->withSum('invoices as invoices_total_before_discount', 'amount')
      ->withSum('invoices as invoices_total_after_discount', 'final_price')
      ->get();
    return response()->json(['outertrans' => $outerTrans]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'tresure_fund_id' => ['integer', 'required'],
      'name' => ['string', 'required'],
      'desc' => ['string', 'nullable'],
      'payed' => ['boolean', 'required'],
      'amount' => ['integer', 'required'],
      'indate' => ['date', 'required'],
    ]);
    OuterTransaction::create($data);
    return response()->json(['message' => 'success']);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    return response()->json(['OuterTransaction' => OuterTransaction::findOrFail($id)]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = $request->validate([
      'name' => ['string', 'required'],
      'desc' => ['string', 'nullable'],
      'payed' => ['boolean', 'required'],
      'amount' => ['integer', 'required'],
      'indate' => ['date', 'required'],
    ]);
    $outertrans = OuterTransaction::findOrFail($id);
    $outertrans->update($data);

    return response()->json(['outertrans' => $outertrans]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $outertrans = OuterTransaction::findOrFail($id);
      $outertrans->delete();
    } catch (\Throwable $th) {
      //throw $th;
    }

    return response()->json(['message' => 'success']);
  }
}
