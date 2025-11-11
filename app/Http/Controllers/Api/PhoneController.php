<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\LogisticTeam;
use App\Models\Phone;
use App\Models\TechnicalTeam;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'type' => ['string','required'],
            'id' => ['required'],
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
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['phones'=>$type->phones,'type'=>$type]);
    }
    public function getphonetypes(Request $request)
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
        }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['phones'=>$type->load('phones')]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['string','required'],
            'id' => ['required'],
            'name' => ['string','required'],
            'number' => ['string','required'],
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
        $type->phones()->create([
            'name'=>$data['name'],
            'number'=>$data['number']
        ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

     public function show(string $id)
    {
        $phone = Phone::findOrFail($id);

        return response()->json(['phone'=>$phone]);
    }
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'type' => ['string','required'],
            'id' => ['required'],
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
        // $type->phones()->update([

        // ])
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['phones'=>$type->phones,'type'=>$type]);
    }
    public function destroy(string $id)
    {
        try {
            $type = Phone::findOrFail($id);
            $type->delete();
        }
        catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['message'=>'success']);
    }
}
