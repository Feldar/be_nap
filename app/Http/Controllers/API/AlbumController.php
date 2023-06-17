<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Resources\AlbumResource;

class AlbumController extends Controller
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
        $registrosAlbum =
            ($busqueda && array_key_exists('q', $busqueda))
            ? Album::where('name_rm', 'like', '%' .$busqueda['q'] . '%')
                ->paginate($numElementos)
            : Album::paginate($numElementos);

            return AlbumResource::collection($registrosAlbum);
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

        $episode = Album::create($episodeData);

        return new AlbumResource($episode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Album $episode)
    {
        return new AlbumResource($episode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $episode)
    {
        $path = json_decode($request->file('file'), true);
        $episodeData = json_decode($request->getContent(), true);
        $episode->update($episodeData['data']['attributes']);

        return new AlbumResource($episode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $episode)
    {
        $episode->delete();
    }
}
