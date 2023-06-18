<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Resources\CharacterResource;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('filter');
        $numElementos = $request->input('numElements');
        $registrosCharacter =
            ($busqueda && array_key_exists('q', $busqueda))
            ? Character::where('name_rm', 'like', '%' .$busqueda['q'] . '%')
                ->paginate($numElementos)
            : Character::paginate($numElementos);

            return CharacterResource::collection($registrosCharacter);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $character = json_decode($request->getContent(), true);
        $characterData = $character['data']['attributes'];

        $character = Character::create($characterData);

        return new CharacterResource($character);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        return new CharacterResource($character);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        $path = json_decode($request->file('file'), true);
        $characterData = json_decode($request->getContent(), true);
        $character->update($characterData['data']['attributes']);

        return new CharacterResource($character);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        $character->delete();
    }
}
