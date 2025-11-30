<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OuterTransaction;
use App\Models\TresureFund;

class ReportsController extends Controller
{
  public function getTresureFundReport(string $tresure_fund_id)
  {
    $tresureFund = TresureFund::findOrFail($tresure_fund_id);

    $outerTransactions = OuterTransaction::where('tresure_fund_id', $tresure_fund_id)
      ->with([
        'invoices.invoiceitem',
      ])
      ->get();

    $items = $outerTransactions
      ->flatMap(function ($outer) {
        return $outer->invoices->flatMap(function ($invoice) {
          return $invoice->invoiceitem;
        });
      })
      ->values();

    return response()->json([
      'message' => 'success',
      'tresure_fund' => $tresureFund,
      'outer_transactions' => $outerTransactions,
      'items' => $items,
    ]);
  }
}
