<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Employee;
use App\Models\EmployeePay;
use App\Models\FinanceItem;
use App\Models\InnerTransaction;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\LogiPay;
use App\Models\LogisticTeam;
use App\Models\MoneyTranfare;
use App\Models\Note;
use App\Models\Office;
use App\Models\OuterTransaction;
use App\Models\TechnicalTeam;
use App\Models\TechPay;
use App\Models\Tresure;
use App\Models\Workshop;
use Illuminate\Http\Request;


class DataController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function home()
  {
    $InnerTransaction = InnerTransaction::all()->sum('amount');;
    $OuterTransaction = OuterTransaction::all()->sum('amount');;
    $temp = $InnerTransaction - $OuterTransaction;


    // $final =  $InnerTransaction->where('payed','=',true) - $OuterTransaction->where('payed','=',true);
    return response()->json(['InnerTransaction' => $InnerTransaction, 'OuterTransaction' => $OuterTransaction, 'temp' => $temp]);
  }
  public function gettresureselector(Request $request)
  {
    $data = $request->validate([
      'type' => ['string', 'required'],
    ]);

    try {
      switch ($data['type']) {
        case 'office':
          $type = Office::all();
          break;
        case 'workshop':
          $type = Workshop::all();
          break;
        case 'admin':
          $type = Admin::all();
          break;
        case 'customer':
          $type = Customer::all();
          break;
        case 'employee':
          $type = Employee::all();
          break;
        case 'deposit':
          $type = Deposit::all();
          break;
      }
    } catch (\Throwable $th) {
      //throw $th;
    }
    return response()->json(['data' => $type]);
  }

  public function getadmintresure(string $id)
  {
    $admin = Admin::findOrFail($id);
    return response()->json(['tresures' => $admin->tresures, 'admin' => $admin]);
  }
  public function getTresureFunds(string $id)
  {
    $tresure = Tresure::findOrFail($id);
    return response()->json(['funds' => $tresure->tresurefunds]);
  }

  public function getnotes(Request $request)
  {
    $data = $request->validate([
      'user_id' => ['integer', 'required'],
    ]);
    $notes = Note::where('user_id', '=', $data['user_id'])->get();
    return response()->json(['notes' => $notes]);
  }
  public function getsocials(Request $request)
  {
    $data = $request->validate([
      'type' => ['string', 'required'],
      'id' => ['required'],
    ]);

    try {
      switch ($data['type']) {
        case 'LogisticTeam':
          $type = LogisticTeam::findOrFail($data['id']);
          break;
        case 'TechnicalTeam':
          $type = TechnicalTeam::findOrFail($data['id']);
          break;
        case 'admin':
          $type = Admin::findOrFail($data['id']);
          break;
        case 'customer':
          $type = Customer::findOrFail($data['id']);
          break;
        case 'employee':
          $type = Employee::findOrFail($data['id']);
          break;
      }
    } catch (\Throwable $th) {
      //throw $th;
    }

    return response()->json(['socials' => $type->socialmedias, 'type' => $type]);
  }
  public function addphone(Request $request)
  {
    $data = $request->validate([
      'name' => ['string', 'max:100', 'required'],
      'number' => ['string', 'max:100', 'required'],
      'type' => ['string', 'required'],
      'id' => ['required'],
    ]);
    return response()->json(['employee_pays' => EmployeePay::all()->load('employee')]);
  }


  public function getemployeepay()
  {
    return response()->json(['employee_pays' => EmployeePay::all()->load('employee')]);
  }
  public function getlogipay()
  {
    return response()->json(['logi_pays' => LogiPay::all()->load('logisticteam')]);
  }
  public function gettechpay()
  {
    return response()->json(['tech_pays' => TechPay::all()->load('technicalteam')]);
  }
  public function getmoneytrans()
  {
    return response()->json(['money_transfare' => MoneyTranfare::all()->load('fromtresurefund', 'totresurefund')]);
  }
  public function getinntrans()
  {
    return response()->json(['inntrans' => InnerTransaction::all()->load('tresurefund', 'invoices')]);
  }
  public function getouttrans()
  {
    return response()->json(['outtrans' => OuterTransaction::all()->load('tresurefund', 'invoices')]);
  }

  // #######################
  public function gettresure()
  {
    return response()->json(['tresure' => Tresure::all()->load('tresureable', 'tresurefund')]);
  }
  // public function gettresurefund()
  // {
  //     return response()->json(['tresurefund'=>TresureFund::all()->load('tresure')]);
  // }
  public function getnote()
  {
    return response()->json(['note' => Note::all()->load('user')]);
  }
  public function getinvoice()
  {
    return response()->json(['invoice' => Invoice::all()->load('financeitem', 'invoiceable')]);
  }
  public function getinvoiceitem()
  {
    return response()->json(['invoiceitem' => InvoiceItem::all()->load('invoice')]);
  }
  public function getfinanceitem()
  {
    return response()->json(['financeitem' => FinanceItem::all()]);
  }
}