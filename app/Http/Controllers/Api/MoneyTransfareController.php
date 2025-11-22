<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MonyTransfer\CreateMonyTransferRequest;
use App\Http\Requests\MonyTransfer\UpdateMonyTransferRequest;
use App\Models\MoneyTranfare;
use App\Models\TresureFund;
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
    $data = $request->validated();

    $from = TresureFund::findOrFail($data['from_tresure_fund_id']);
    $to = TresureFund::findOrFail($data['to_tresure_fund_id']);

    if ($from->amount < $data['amount']) {
      return response()->json([
        'message' => 'Not enough money in the sending fund',
      ], 400);
    }

    $from->amount -= $data['amount'];
    $from->save();

    $to->amount += $data['amount'];
    $to->save();

    $moneyTransfer = MoneyTranfare::create([
      'name' => $data['name'],
      'desc' => $data['desc'] ?? null,
      'amount' => $data['amount'],
      'from_tresure_fund_id' => $data['from_tresure_fund_id'],
      'to_tresure_fund_id' => $data['to_tresure_fund_id'],
    ]);

    return response()->json([
      'message' => 'Money transfer created',
      'moneyTransfer' => $moneyTransfer,
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
    $data = $request->validated();


    $money = MoneyTranfare::findOrFail($id);

    $oldFrom = TresureFund::findOrFail($money->from_tresure_fund_id);
    $oldTo   = TresureFund::findOrFail($money->to_tresure_fund_id);

    $oldFrom->amount += $money->amount;
    $oldFrom->save();

    $oldTo->amount -= $money->amount;
    $oldTo->save();

    $newFromId = $data['from_tresure_fund_id'] ?? $money->from_tresure_fund_id;
    $newToId   = $data['to_tresure_fund_id'] ?? $money->to_tresure_fund_id;
    $newAmount = $data['amount'] ?? $money->amount;

    $newFrom = TresureFund::findOrFail($newFromId);
    $newTo   = TresureFund::findOrFail($newToId);

    if ($newFrom->amount < $newAmount) {
      return response()->json([
        'message' => 'Not enough money in the sending fund',

      ], 400);
    }

    $newFrom->amount -= $newAmount;
    $newFrom->save();

    $newTo->amount += $newAmount;
    $newTo->save();

    $money->update([
      'name' => $data['name'] ?? $money->name,
      'desc' => $data['desc'] ?? $money->desc,
      'amount' => $newAmount,
      'from_tresure_fund_id' => $newFromId,
      'to_tresure_fund_id' => $newToId,
    ]);

    return response()->json([
      'message' => 'Money transfer updated successfully',
      'moneyTransfer' => $money,
    ]);
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(MoneyTranfare $moneytransfare)
  {
    $moneytransfare->delete();
    return response()->json(['message' => 'Money transfer deleted']);
  }
}
