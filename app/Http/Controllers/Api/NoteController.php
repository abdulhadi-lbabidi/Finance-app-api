<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['integer','required'],
        ]);
        $notes = Note::where('user_id','=',$data['user_id'])->get();
        return response()->json(['notes'=>$notes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['string','required'],
            'description' => ['string','required'],
            'is_active' => ['boolean','required'],
            'user_id' => ['required','integer'],
        ]);
        $note =Note::create($data);
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::findOrFail($id);

        return response()->json(['note'=>$note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => ['string','required'],
            'description' => ['string','required'],
            'is_active' => ['boolean','required'],
            'user_id' => ['required','integer'],
        ]);

        $note = Note::findOrFail($id);
        $note->update($data);

        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json(['message'=>'success']);

    }
}
