<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Tresure;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TresureController extends Controller
{

  public function getTresureByType()
  {
    $tresures = Tresure::all();
    return response()->json(['tresures' => $tresures]);
  }
  public function getadmintresure(string $id)
  {
    // $workshops = Workshop::with('tresures.tresurefunds.moneyGets')->get();
    // foreach ($workshops as $workshop) {
    //     $sum = 0;
    //     foreach ($workshop->tresures as $tresures) {
    //         foreach ($tresures->tresurefunds as $tresurefunds) {
    //             $sum += $tresurefunds->moneyTransfares->sum('amount');
    //         }
    //     }
    //     $test=$sum;
    // }

    $admin = Admin::findOrFail($id);
    return response()->json(['tresures' => $admin->tresures, 'admin' => $admin]);
  }
  public function getworkshoptresure(string $id)
  {
    $workshop = Workshop::findOrFail($id);
    return response()->json(['tresures' => $workshop->tresures]);
  }
  public function getcustomertresure(string $id)
  {
    $customer = Customer::findOrFail($id);
    return response()->json(['tresures' => $customer->tresures, 'customer' => $customer]);
  }
  public function getemployeetresure(string $id)
  {
    $employee = Employee::findOrFail($id);
    return response()->json(['tresures' => $employee->tresures, 'workshop' => $employee]);
  }
  public function getTresureFunds(string $id)
  {
    $tresure = Tresure::findOrFail($id);
    return response()->json(['funds' => $tresure->tresurefunds]);
  }
}