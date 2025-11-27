<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tresure\CreateTresureRequest;
use App\Http\Requests\Tresure\UpdateTresureRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Employee;
use App\Models\InnerTransaction;
use App\Models\MoneyTranfare;
use App\Models\Office;
use App\Models\OuterTransaction;
use App\Models\Tresure;
use App\Models\Workshop;


class TresureController extends Controller
{

  public function store(CreateTresureRequest $request)
  {
    $tresure = Tresure::create($request->validated());

    return response()->json([
      'message' => 'tresure created successfully',
      'tresure' => $tresure
    ], 201);
  }

  public function update(UpdateTresureRequest $request, Tresure $tresure)
  {
    $tresure->update($request->validated());

    return response()->json([
      'message' => 'tresure updated successfully',
      'tresure' => $tresure,
    ], 200);
  }

  public function destroy(Tresure $tresure)
  {
    $tresure->delete();

    return response()->json(['message' => 'tresure deleted successfully']);
  }
  public function show(Tresure $tresure)
  {
    $funds = $tresure->tresurefunds()->pluck('id'); // IDs كل الملحقات

    // التحويلات الصادرة
    $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
      ->sum('amount');

    // التحويلات الواردة
    $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
      ->sum('amount');

    // مجموع كل مبالغ التحويلات (incoming + outgoing)
    $totalTransfersSum = $totalIncomingTransfers + $totalOutgoingTransfers;

    // المعاملات الداخلية
    $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
      ->sum('amount');

    // المعاملات الخارجية
    $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
      ->sum('amount');

    // عدد الملحقات
    $fundCount = $tresure->tresurefunds()->count();

    return response()->json([
      'tresure' => $tresure->load('tresurefunds'),
      'stats' => [
        'fund_count'        => $fundCount,
        'total_outgoing'    => $totalOutgoingTransfers,
        'total_incoming'    => $totalIncomingTransfers,
        'total_transfers_sum'  => $totalTransfersSum,
        'total_inners'      => $totalInners,
        'total_outers'      => $totalOuters,
      ]
    ]);
  }

  public function getTresureByType()
  {
    // $types = Tresure::pluck('tresureable_type')->unique()->values();
    $types = [
      "admin",
      "customer",
      "office",
      "workshop",
      "employee",
      "deposit",
    ];

    return response()->json(['truserTtype' => $types]);
  }

  // public function getadmintresure(string $id)
  // {
  //   // $workshops = Workshop::with('tresures.tresurefunds.moneyGets')->get();
  //   // foreach ($workshops as $workshop) {
  //   //     $sum = 0;
  //   //     foreach ($workshop->tresures as $tresures) {
  //   //         foreach ($tresures->tresurefunds as $tresurefunds) {
  //   //             $sum += $tresurefunds->moneyTransfares->sum('amount');
  //   //         }
  //   //     }
  //   //     $test=$sum;
  //   // }

  //   $admin = Admin::findOrFail($id);
  //   return response()->json(['tresures' => $admin->tresures, 'admin' => $admin]);
  // }

  public function getAdminTresure(string $id)
  {
    $admin = Admin::findOrFail($id);

    $totalTresureCount = $admin->tresures()->count();
    $tresures = $admin->tresures()
      ->with('tresurefunds')
      ->get()
      ->map(function ($tresure) {
        $funds = $tresure->tresurefunds()->pluck('id');

        $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
          ->sum('amount');

        $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
          ->sum('amount');

        $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $fundCount = $tresure->tresurefunds()->count();

        $totalTransfersSum = $totalOutgoingTransfers + $totalIncomingTransfers;

        return [
          'tresure' => $tresure,
          'stats' => [
            'fund_count' => $fundCount,
            'total_outgoing' => $totalOutgoingTransfers,
            'total_incoming' => $totalIncomingTransfers,
            'total_inners' => $totalInners,
            'total_outers' => $totalOuters,
            'total_transfers_sum' => $totalTransfersSum,
          ]
        ];
      });

    $totals = [
      'total_tresure_count' => $admin->tresures()->count(),

      'total_fund_count' => $tresures->sum(fn($t) => $t['stats']['fund_count']),
      'total_outgoing'   => $tresures->sum(fn($t) => $t['stats']['total_outgoing']),
      'total_incoming'   => $tresures->sum(fn($t) => $t['stats']['total_incoming']),
      'total_inners'     => $tresures->sum(fn($t) => $t['stats']['total_inners']),
      'total_outers'     => $tresures->sum(fn($t) => $t['stats']['total_outers']),
      'total_transfers_sum' => $tresures->sum(fn($t) => $t['stats']['total_transfers_sum']),
    ];

    return response()->json([
      'admin' => $admin,
      'tresures' => $tresures,
      'totals' => $totals,
    ]);
  }

  public function getworkshoptresure(string $id)
  {
    // $workshop = Workshop::findOrFail($id);
    // return response()->json(['tresures' => $workshop->tresures, 'workshop' => $workshop]);

    $workshop = Workshop::findOrFail($id);

    $totalTresureCount = $workshop->tresures()->count();
    $tresures = $workshop->tresures()
      ->with('tresurefunds')
      ->get()
      ->map(function ($tresure) {
        $funds = $tresure->tresurefunds()->pluck('id');

        $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
          ->sum('amount');

        $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
          ->sum('amount');

        $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $fundCount = $tresure->tresurefunds()->count();

        $totalTransfersSum = $totalOutgoingTransfers + $totalIncomingTransfers;

        return [
          'tresure' => $tresure,
          'stats' => [
            'fund_count' => $fundCount,
            'total_outgoing' => $totalOutgoingTransfers,
            'total_incoming' => $totalIncomingTransfers,
            'total_inners' => $totalInners,
            'total_outers' => $totalOuters,
            'total_transfers_sum' => $totalTransfersSum,
          ]
        ];
      });

    $totals = [
      'total_tresure_count' => $workshop->tresures()->count(),

      'total_fund_count' => $tresures->sum(fn($t) => $t['stats']['fund_count']),
      'total_outgoing'   => $tresures->sum(fn($t) => $t['stats']['total_outgoing']),
      'total_incoming'   => $tresures->sum(fn($t) => $t['stats']['total_incoming']),
      'total_inners'     => $tresures->sum(fn($t) => $t['stats']['total_inners']),
      'total_outers'     => $tresures->sum(fn($t) => $t['stats']['total_outers']),
      'total_transfers_sum' => $tresures->sum(fn($t) => $t['stats']['total_transfers_sum']),
    ];

    return response()->json([
      'workshop' => $workshop,
      'tresures' => $tresures,
      'totals' => $totals,
    ]);
  }
  public function getcustomertresure(string $id)
  {
    // $customer = Customer::findOrFail($id);
    // return response()->json(['tresures' => $customer->tresures, 'customer' => $customer]);

    $customer = Customer::findOrFail($id);

    $totalTresureCount = $customer->tresures()->count();
    $tresures = $customer->tresures()
      ->with('tresurefunds')
      ->get()
      ->map(function ($tresure) {
        $funds = $tresure->tresurefunds()->pluck('id');

        $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
          ->sum('amount');

        $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
          ->sum('amount');

        $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $fundCount = $tresure->tresurefunds()->count();

        $totalTransfersSum = $totalOutgoingTransfers + $totalIncomingTransfers;

        return [
          'tresure' => $tresure,
          'stats' => [
            'fund_count' => $fundCount,
            'total_outgoing' => $totalOutgoingTransfers,
            'total_incoming' => $totalIncomingTransfers,
            'total_inners' => $totalInners,
            'total_outers' => $totalOuters,
            'total_transfers_sum' => $totalTransfersSum,
          ]
        ];
      });

    $totals = [
      'total_tresure_count' => $customer->tresures()->count(),

      'total_fund_count' => $tresures->sum(fn($t) => $t['stats']['fund_count']),
      'total_outgoing'   => $tresures->sum(fn($t) => $t['stats']['total_outgoing']),
      'total_incoming'   => $tresures->sum(fn($t) => $t['stats']['total_incoming']),
      'total_inners'     => $tresures->sum(fn($t) => $t['stats']['total_inners']),
      'total_outers'     => $tresures->sum(fn($t) => $t['stats']['total_outers']),
      'total_transfers_sum' => $tresures->sum(fn($t) => $t['stats']['total_transfers_sum']),
    ];

    return response()->json([
      'customer' => $customer,
      'tresures' => $tresures,
      'totals' => $totals,
    ]);
  }
  public function getemployeetresure(string $id)
  {
    // $employee = Employee::findOrFail($id);
    // return response()->json(['tresures' => $employee->tresures, 'workshop' => $employee]);

    $employee = Employee::findOrFail($id);

    $totalTresureCount = $employee->tresures()->count();
    $tresures = $employee->tresures()
      ->with('tresurefunds')
      ->get()
      ->map(function ($tresure) {
        $funds = $tresure->tresurefunds()->pluck('id');

        $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
          ->sum('amount');

        $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
          ->sum('amount');

        $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $fundCount = $tresure->tresurefunds()->count();

        $totalTransfersSum = $totalOutgoingTransfers + $totalIncomingTransfers;

        return [
          'tresure' => $tresure,
          'stats' => [
            'fund_count' => $fundCount,
            'total_outgoing' => $totalOutgoingTransfers,
            'total_incoming' => $totalIncomingTransfers,
            'total_inners' => $totalInners,
            'total_outers' => $totalOuters,
            'total_transfers_sum' => $totalTransfersSum,
          ]
        ];
      });

    $totals = [
      'total_tresure_count' => $employee->tresures()->count(),

      'total_fund_count' => $tresures->sum(fn($t) => $t['stats']['fund_count']),
      'total_outgoing'   => $tresures->sum(fn($t) => $t['stats']['total_outgoing']),
      'total_incoming'   => $tresures->sum(fn($t) => $t['stats']['total_incoming']),
      'total_inners'     => $tresures->sum(fn($t) => $t['stats']['total_inners']),
      'total_outers'     => $tresures->sum(fn($t) => $t['stats']['total_outers']),
      'total_transfers_sum' => $tresures->sum(fn($t) => $t['stats']['total_transfers_sum']),
    ];

    return response()->json([
      'employee' => $employee,
      'tresures' => $tresures,
      'totals' => $totals,
    ]);
  }

  public function getDeposittresure(string $id)
  {
    $deposit = Deposit::findOrFail($id);

    $totalTresureCount = $deposit->tresures()->count();
    $tresures = $deposit->tresures()
      ->with('tresurefunds')
      ->get()
      ->map(function ($tresure) {
        $funds = $tresure->tresurefunds()->pluck('id');

        $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
          ->sum('amount');

        $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
          ->sum('amount');

        $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $fundCount = $tresure->tresurefunds()->count();

        $totalTransfersSum = $totalOutgoingTransfers + $totalIncomingTransfers;

        return [
          'tresure' => $tresure,
          'stats' => [
            'fund_count' => $fundCount,
            'total_outgoing' => $totalOutgoingTransfers,
            'total_incoming' => $totalIncomingTransfers,
            'total_inners' => $totalInners,
            'total_outers' => $totalOuters,
            'total_transfers_sum' => $totalTransfersSum,
          ]
        ];
      });

    $totals = [
      'total_tresure_count' => $deposit->tresures()->count(),

      'total_fund_count' => $tresures->sum(fn($t) => $t['stats']['fund_count']),
      'total_outgoing'   => $tresures->sum(fn($t) => $t['stats']['total_outgoing']),
      'total_incoming'   => $tresures->sum(fn($t) => $t['stats']['total_incoming']),
      'total_inners'     => $tresures->sum(fn($t) => $t['stats']['total_inners']),
      'total_outers'     => $tresures->sum(fn($t) => $t['stats']['total_outers']),
      'total_transfers_sum' => $tresures->sum(fn($t) => $t['stats']['total_transfers_sum']),
    ];

    return response()->json([
      'deposit' => $deposit,
      'tresures' => $tresures,
      'totals' => $totals,
    ]);
  }
  public function getOfficetresure(string $id)
  {
    $office = Office::findOrFail($id);

    $totalTresureCount = $office->tresures()->count();
    $tresures = $office->tresures()
      ->with('tresurefunds')
      ->get()
      ->map(function ($tresure) {
        $funds = $tresure->tresurefunds()->pluck('id');

        $totalOutgoingTransfers = MoneyTranfare::whereIn('from_tresure_fund_id', $funds)
          ->sum('amount');

        $totalIncomingTransfers = MoneyTranfare::whereIn('to_tresure_fund_id', $funds)
          ->sum('amount');

        $totalInners = InnerTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $totalOuters = OuterTransaction::whereIn('tresure_fund_id', $funds)
          ->sum('amount');

        $fundCount = $tresure->tresurefunds()->count();

        $totalTransfersSum = $totalOutgoingTransfers + $totalIncomingTransfers;

        return [
          'tresure' => $tresure,
          'stats' => [
            'fund_count' => $fundCount,
            'total_outgoing' => $totalOutgoingTransfers,
            'total_incoming' => $totalIncomingTransfers,
            'total_inners' => $totalInners,
            'total_outers' => $totalOuters,
            'total_transfers_sum' => $totalTransfersSum,
          ]
        ];
      });

    $totals = [
      'total_tresure_count' => $office->tresures()->count(),

      'total_fund_count' => $tresures->sum(fn($t) => $t['stats']['fund_count']),
      'total_outgoing'   => $tresures->sum(fn($t) => $t['stats']['total_outgoing']),
      'total_incoming'   => $tresures->sum(fn($t) => $t['stats']['total_incoming']),
      'total_inners'     => $tresures->sum(fn($t) => $t['stats']['total_inners']),
      'total_outers'     => $tresures->sum(fn($t) => $t['stats']['total_outers']),
      'total_transfers_sum' => $tresures->sum(fn($t) => $t['stats']['total_transfers_sum']),
    ];

    return response()->json([
      'office' => $office,
      'tresures' => $tresures,
      'totals' => $totals,
    ]);
  }

  public function getUsersByType(string $type)
  {
    switch ($type) {
      case 'office':
        $data = Office::select('id', 'name')->get();
        break;
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
      case 'deposit':
        $data = Deposit::select('id', 'name')->get();
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