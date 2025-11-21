<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TresureFund;
use Illuminate\Http\Request;

class TresureFundController extends Controller
{
  public function index()
  {
    return response()->json([
      "tresure_funds" => TresureFund::all()
    ], 200);
  }

  public function getTresureFundsByTresureId(string $tresure_id)
  {

    $funds = TresureFund::where('tresure_id', $tresure_id)
      ->select('id', 'name')
      ->get();

    return response()->json([
      'funds' => $funds
    ]);
  }
}
