<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\LogisticTeam;
use App\Models\TechnicalTeam;
use App\Models\Workshop;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'type' => ['string','required'],
        ]);

        try {
            switch ($data['type']) {
            case 'LogisticTeam':
                $type =LogisticTeam::all();
                break;
            case 'TechnicalTeam':
                $type =TechnicalTeam::all();
                break;
            case 'admin':
                $type =Admin::all();
                break;
            case 'customer':
                $type =Customer::all();
                break;
            case 'employee':
                $type =Employee::all();
                break;
            case 'workshop':
                $type =Workshop::all();
                break;
        }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['inventory'=>$type->load('inventories')]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['string','required'],
            'id' => ['required'],
            'name' => ['string','required'],
            'quantity' => ['integer','required'],
            'statue'=> ['boolean','required'],
            'for'=> ['string','required'],
            'fromdate'=> ['date','required'],
        ]);
        try {
            switch ($data['type']) {
            case 'LogisticTeam':
                $type =LogisticTeam::findOrFail($data['id']);
                break;
            case 'TechnicalTeam':
                $type =TechnicalTeam::findOrFail($data['id']);
                break;
            case 'admin':
                $type =Admin::findOrFail($data['id']);
                break;
            case 'customer':
                $type =Customer::findOrFail($data['id']);
                break;
            case 'employee':
                $type =Employee::findOrFail($data['id']);
                break;
        }
        $type->inventories()->create([
            'name'=>$data['name'],
            'quantity'=>$data['quantity'],
            'statue'=>$data['statue'],
            'type'=>$data['for'],
            'fromdate'=>$data['fromdate'],
        ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json(['message'=>'success']);
    }

     public function show(string $id)
    {
        $inventory = Inventory::findOrFail($id);

        return response()->json(['inventory'=>$inventory]);
    }
    public function update( string $id,Request $request)
    {
        $data = $request->validate([
            'name' => ['string','required'],
            'quantity' => ['integer','required'],
            'statue'=> ['boolean','required'],
            'type'=> ['string','required'],
            'fromdate'=> ['date','required'],
        ]);
        $inventory = Inventory::findOrFail($id);
        $inventory->update($data);


        return response()->json(['inventory'=>$inventory]);
    }
    public function destroy(string $id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();
        }
        catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['message'=>'success']);
    }
}
