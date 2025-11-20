<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MonyTransfer\CreateMonyTransferRequest;
use App\Http\Requests\MonyTransfer\UpdateMonyTransferRequest;
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
      'tresurefund_id' => ['integer', 'required'],
    ]);
    $MoneyTranfare = MoneyTranfare::where(
      'from_tresure_fund_id',
      '=',
      $data['tresurefund_id']
    )->orWhere(
      'to_tresure_fund_id',
      '=',
      $data['tresurefund_id']
    )
      ->orderBy('updated_at', 'desc')
      ->with(['totresurefund', 'fromtresurefund'])
      ->get();
    return response()->json(['moneytrans' => $MoneyTranfare]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CreateMonyTransferRequest $request)
  {
    $moneyTransfer = MoneyTranfare::create($request->validated());
    return response()->json([
      'message' => 'Money transfer created',
      'moneyTransfer' => $moneyTransfer
    ], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $moneyTransfare = MoneyTranfare::findOrFail($id);
    $moneyTransfare->load('fromtresurefund', 'totresurefund');
    return response()->json(['moneyTransfer' => $moneyTransfare]);
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateMonyTransferRequest $request, $id)
  {
    $moneyTransfare = MoneyTranfare::findOrFail($id);
    $moneyTransfare->update($request->validated());
    return response()->json(['message' => 'Money transfer updated', 'moneyTransfer' => $moneyTransfare]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(MoneyTranfare $moneyTranfare)
  {
    $moneyTranfare->delete();
    return response()->json(['message' => 'Money transfer deleted']);
  }
}
