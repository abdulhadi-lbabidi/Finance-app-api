<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaType;
use Illuminate\Http\Request;

class SocialmediaTypeController extends Controller
{
    public function index()
    {
        return response()->json(['types'=>SocialMediaType::all()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:255','required'],
            // 'vec_url'=> ['string','max:255','required'],
        ]);
        $type = SocialMediaType::create($data);

        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['type'=>SocialMediaType::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
        ]);

        $type = SocialMediaType::findOrFail($id);
        $type->update($data);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = SocialMediaType::findOrFail($id);
        $type->delete();
        return response()->json(['admin'=>SocialMediaType::all()]);
    }

}
