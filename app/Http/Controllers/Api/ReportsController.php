<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tresure;
use App\Models\TresureFund;

class ReportsController extends Controller
{
  private function loadFundsWithRelations($query)
  {
    return $query->with([
      'outerTransactions.invoices.financeitem',
      'outerTransactions.invoices.invoiceitem',
    ])->get();
  }

  private function extractItems($funds)
  {
    return $funds->flatMap(function ($fund) {
      return $fund->outerTransactions->flatMap(function ($outer) {
        return $outer->invoices->flatMap(function ($invoice) {
          return $invoice->invoiceitem->map(function ($item) use ($invoice) {
            $item->finance_item_name = $invoice->financeitem->name ?? null;
            return $item;
          });
        });
      });
    })->values();
  }

  // =====================================================================
  // ===  Reports ========================================================
  // =====================================================================

  public function getTresureFundReport(string $tresure_fund_id)
  {
    $tresureFund = TresureFund::findOrFail($tresure_fund_id);

    $funds = $this->loadFundsWithRelations(
      TresureFund::where('id', $tresure_fund_id)
    );

    $items = $this->extractItems($funds);

    return response()->json([
      'tresure_fund' => $tresureFund,
      'outer_transactions' => $funds->first()->outerTransactions ?? [],
      'items' => $items,
    ]);
  }

  public function getTresureFundsReport(string $tresure_id)
  {
    $tresure = Tresure::findOrFail($tresure_id);

    $funds = $this->loadFundsWithRelations(
      $tresure->tresurefunds()
    );

    $items = $this->extractItems($funds);

    return response()->json([
      "tresure" => $tresure,
      "funds"   => $funds,
      "items"   => $items,
    ]);
  }

  public function getTresuresReport(string $user_type, string $user_id)
  {
    $tresures = Tresure::where('tresureable_type', $user_type)
      ->where('tresureable_id', $user_id)
      ->get();

    $funds = $this->loadFundsWithRelations(
      TresureFund::whereIn('tresure_id', $tresures->pluck('id'))
    );

    $items = $this->extractItems($funds);

    return response()->json([
      "tresures" => $tresures,
      "funds"    => $funds,
      "items"    => $items,
    ]);
  }

  public function getTresuresforAllusersReport(string $user_type)
  {
    $tresures = Tresure::where('tresureable_type', $user_type)->get();

    $funds = $this->loadFundsWithRelations(
      TresureFund::whereIn('tresure_id', $tresures->pluck('id'))
    );

    $items = $this->extractItems($funds);

    return response()->json([
      "tresures" => $tresures,
      "funds"    => $funds,
      "items"    => $items,
    ]);
  }
}
