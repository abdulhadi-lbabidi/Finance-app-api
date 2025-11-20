<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InnerTransaction;
use Illuminate\Http\Request;

class InnerTransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $data = $request->validate([
      'tresurefund_id' => ['integer', 'required'],
    ]);
    $innerTrans = InnerTransaction::where('tresure_fund_id', $data['tresurefund_id'])
      ->withSum('invoices as invoices_total_before_discount', 'amount')
      ->withSum('invoices as invoices_total_after_discount', 'final_price')
      ->get();
    return response()->json(['innertrans' => $innerTrans]);
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
    InnerTransaction::create($data);
    return response()->json(['message' => 'success']);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    return response()->json(['InnerTransaction' => InnerTransaction::findOrFail($id)]);
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
    $innertrans = InnerTransaction::findOrFail($id);
    $innertrans->update($data);

    return response()->json(['innertrans' => $innertrans]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $innertrans = InnerTransaction::findOrFail($id);
      $innertrans->delete();
    } catch (\Throwable $th) {
      //throw $th;
    }

    return response()->json(['message' => 'success']);
  }
}
