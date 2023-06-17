<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Resources\ArtistResource;

class ArtistController extends Controller
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
        $registrosArtist =
            ($busqueda && array_key_exists('q', $busqueda))
            ? Artist::where('name_rm', 'like', '%' .$busqueda['q'] . '%')
                ->paginate($numElementos)
            : Artist::paginate($numElementos);

            return ArtistResource::collection($registrosArtist);
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

        $episode = Artist::create($episodeData);

        return new ArtistResource($episode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $episode)
    {
        return new ArtistResource($episode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $episode)
    {
        $path = json_decode($request->file('file'), true);
        $episodeData = json_decode($request->getContent(), true);
        $episode->update($episodeData['data']['attributes']);

        return new ArtistResource($episode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $episode)
    {
        $episode->delete();
    }
}
