<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Resources\SongResource;

class SongController extends Controller
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
        $registrosSong =
            ($busqueda && array_key_exists('q', $busqueda))
            ? Song::where('name_rm', 'like', '%' .$busqueda['q'] . '%')
                ->paginate($numElementos)
            : Song::paginate($numElementos);

            return SongResource::collection($registrosSong);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $song = json_decode($request->getContent(), true);
        $songData = $song['data']['attributes'];

        $song = Song::create($songData);

        return new SongResource($song);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        return new SongResource($song);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        $path = json_decode($request->file('file'), true);
        $songData = json_decode($request->getContent(), true);
        $song->update($songData['data']['attributes']);

        return new SongResource($song);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->delete();
    }
}
