<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tresure;
use App\Models\Workshop;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function getItemsReport(string $id)
    {

        return response()->json(['message'=>'success']);
    }
}
