<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Resources\EpisodeResource;

class EpisodeController extends Controller
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
        $registrosEpisode =
            ($busqueda && array_key_exists('q', $busqueda))
            ? Episode::where('name_rm', 'like', '%' .$busqueda['q'] . '%')
                ->paginate($numElementos)
            : Episode::paginate($numElementos);

            return EpisodeResource::collection($registrosEpisode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fileupload
        $request->validate([
            'file' => 'required|file'
        ]);
        $path = $request->file('file')->store('files');

        $episode = json_decode($request->getContent(), true);
        $episodeData = $episode['data']['attributes'];

        // fileupload
        $episodeData['file'] = $path;

        $episode = Episode::create($episodeData);

        return new EpisodeResource($episode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        return new EpisodeResource($episode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        $path = json_decode($request->file('file'), true);
        $episodeData = json_decode($request->getContent(), true);
        $episode->update($episodeData['data']['attributes']);

        return new EpisodeResource($episode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();
    }
}
