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

        $episode = json_decode($request->getContent(), true);
        $episodeData = $episode['data']['attributes'];

        $episode = Song::create($episodeData);

        return new SongResource($episode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Song $episode)
    {
        return new SongResource($episode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $episode)
    {
        $path = json_decode($request->file('file'), true);
        $episodeData = json_decode($request->getContent(), true);
        $episode->update($episodeData['data']['attributes']);

        return new SongResource($episode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $episode)
    {
        $episode->delete();
    }
}
