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
}
