<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OuterTransaction;
use App\Models\Tresure;
use App\Models\TresureFund;

class ReportsController extends Controller
{
  public function getTresureFundReport(string $tresure_fund_id)
  {
    $tresureFund = TresureFund::findOrFail($tresure_fund_id);

    $outerTransactions = OuterTransaction::where('tresure_fund_id', $tresure_fund_id)
      ->with([
        'invoices.financeitem',
        'invoices.invoiceitem',
      ])
      ->get();

    $items = $outerTransactions
      ->flatMap(function ($outer) {
        return $outer->invoices->flatMap(function ($invoice) {
          return $invoice->invoiceitem->map(function ($item) use ($invoice) {

            $item->finance_item_name = $invoice->financeitem->name ?? null;

            return $item;
          });
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


  public function getTresureFundsReport(string $tresure_id)
  {

    $tresure = Tresure::findOrFail($tresure_id);

    $funds = $tresure->tresurefunds()
      ->with([
        'outerTransactions.invoices.financeitem',
        'outerTransactions.invoices.invoiceitem',
      ])
      ->get();

    $items = $funds->flatMap(function ($fund) {
      return $fund->outerTransactions->flatMap(function ($outer) {
        return $outer->invoices->flatMap(function ($invoice) {
          return $invoice->invoiceitem->map(function ($item) use ($invoice) {
            $item->finance_item_name = $invoice->financeitem->name ?? null;
            return $item;
          });
        });
      });
    })->values();

    return response()->json([
      "message" => "success",
      "tresure" => $tresure,
      "funds" => $funds,
      "items" => $items,
    ]);
  }


  public function getTresuresReport(string $user_type, string $user_id)
  {
    $tresures = Tresure::where('tresureable_type', $user_type)
      ->where('tresureable_id', $user_id)
      ->get();


    $funds = TresureFund::whereIn('tresure_id', $tresures->pluck('id'))
      ->with([
        'outerTransactions.invoices.financeitem',
        'outerTransactions.invoices.invoiceitem',
      ])
      ->get();

    $items = $funds->flatMap(function ($fund) {
      return $fund->outerTransactions->flatMap(function ($outer) {
        return $outer->invoices->flatMap(function ($invoice) {
          return $invoice->invoiceitem->map(function ($item) use ($invoice) {
            $item->finance_item_name = $invoice->financeitem->name ?? null;
            return $item;
          });
        });
      });
    })->values();

    return response()->json([
      "message"   => "success",
      "tresures"  => $tresures,
      "funds"     => $funds,
      "items"     => $items,
    ]);
  }

  public function getTresuresforAllusersReport(string $user_type)
  {

    $tresures = Tresure::where('tresureable_type', $user_type)->get();

    $funds = TresureFund::whereIn('tresure_id', $tresures->pluck('id'))
      ->with([
        'outerTransactions.invoices.financeitem',
        'outerTransactions.invoices.invoiceitem',
      ])
      ->get();


    $items = $funds->flatMap(function ($fund) {
      return $fund->outerTransactions->flatMap(function ($outer) {
        return $outer->invoices->flatMap(function ($invoice) {
          return $invoice->invoiceitem->map(function ($item) use ($invoice) {
            $item->finance_item_name = $invoice->financeitem->name ?? null;
            return $item;
          });
        });
      });
    })->values();

    return response()->json([
      "message"   => "success",
      "tresures"  => $tresures,
      "funds"     => $funds,
      "items"     => $items,
    ]);
  }
}
