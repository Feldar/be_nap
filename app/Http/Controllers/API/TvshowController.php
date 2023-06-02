<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tvshow;
use Illuminate\Http\Request;
use App\Http\Resources\TvshowResource;

class TvshowController extends Controller
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
        $registrosTvshows =
            ($busqueda && array_key_exists('q', $busqueda))
            ? Tvshow::where('name', 'like', '%' .$busqueda['q'] . '%')
                ->paginate($numElementos)
            : Tvshow::paginate($numElementos);

            return TvshowResource::collection($registrosTvshows);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tvshow = json_decode($request->getContent(), true);
        $tvshowData = $tvshow['data']['attributes'];

        $tvshow = Tvshow::create($tvshowData);

        return new TvshowResource($tvshow);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tvshow  $tvshow
     * @return \Illuminate\Http\Response
     */
    public function show(Tvshow $tvshow)
    {
        return new TvshowResource($tvshow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tvshow  $tvshow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tvshow $tvshow)
    {
        $tvshowData = json_decode($request->getContent(), true);
        $tvshow->update($tvshowData['data']['attributes']);

        return new TvshowResource($tvshow);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tvshow  $tvshow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tvshow $tvshow)
    {
        $tvshow->delete();
    }
}
