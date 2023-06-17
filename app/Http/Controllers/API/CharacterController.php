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

        $episode = json_decode($request->getContent(), true);
        $episodeData = $episode['data']['attributes'];

        $episode = Character::create($episodeData);

        return new CharacterResource($episode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Character $episode)
    {
        return new CharacterResource($episode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $episode)
    {
        $path = json_decode($request->file('file'), true);
        $episodeData = json_decode($request->getContent(), true);
        $episode->update($episodeData['data']['attributes']);

        return new CharacterResource($episode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $episode)
    {
        $episode->delete();
    }
}
