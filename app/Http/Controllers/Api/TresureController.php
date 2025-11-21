<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Tresure;
use App\Models\Workshop;


class TresureController extends Controller
{

  public function getTresureByType()
  {
    $types = Tresure::pluck('tresureable_type')->unique()->values();

    return response()->json(['truserTtype' => $types]);
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
    return response()->json(['tresures' => $workshop->tresures, 'workshop' => $workshop]);
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

  public function getUsersByType(string $type)
  {
    switch ($type) {
      case 'admin':
        $data = Admin::select('id', 'name')->get();
        break;

      case 'employee':
        $data = Employee::select('id', 'name')->get();
        break;

      case 'workshop':
        $data = Workshop::select('id', 'name')->get();
        break;

      case 'customer':
        $data = Customer::select('id', 'name')->get();
        break;

      default:
        return response()->json(['error' => 'invalid type'], 400);
    }

    return response()->json([
      'users' => $data
    ]);
  }

  public function getTresuresByUser(string $user_id, string $type)
  {
    $tresures = Tresure::where('tresureable_id', $user_id)
      ->where('tresureable_type', $type)
      ->select('id', 'name')
      ->get();

    return response()->json([
      'tresures' => $tresures
    ]);
  }
}
