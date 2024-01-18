<?php

namespace App\Http\Controllers;

use App\Models\Asupan;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardAsupanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $asupans = Asupan::where('user_id', auth()->user()->id)
                        ->when($keyword, function ($query) use ($keyword) {
                            return $query->where('title', 'like', '%'.$keyword.'%');
                        })
                        ->simplePaginate(10);

        $asupans->withPath('?' . http_build_query($request->query()))
        ->appends(request()->query())
        ->each(function ($item, $index) use ($asupans) {
            $item->iteration = ($asupans->currentPage() - 1) * $asupans->perPage() + $index + 1;
        });

        return view('dashboard.asupans.index', compact('asupans'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.asupans.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:asupans',
            'image_cover' => 'image|file|max:1024',
            'deskripsi_gizi' => 'required',
            'youtube_url' => 'required'
        ]);

        if ($request->file('image_cover')) {
            $validateData['image_cover'] = $request->file('image_cover')->store('asupan-images');
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->deskripsi_gizi), 200);

        Asupan::create($validateData);

        return redirect('/dashboard/asupans')->with('success', 'New asupan gizi has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asupan 
     * @return \Illuminate\Http\Response
     */
    public function show(Asupan $asupan)
    {
        $url = $asupan->youtube_url;
        $parsed = parse_url($url);

        if ($parsed['host'] === 'youtu.be') {
            $videoId = ltrim($parsed['path'], '/');
            $asupan->youtube_id = $videoId;
        }

        return view('dashboard.asupans.show', [
            'asupan' => $asupan
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asupan  
     * @return \Illuminate\Http\Response
     */
    public function edit(Asupan $asupan)
    {
        return view('dashboard.asupans.edit', [
            'asupan' => $asupan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asupan 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asupan $asupan)
    {
        $rules = [
            'title' => 'required|max:255',
            'image_cover' => 'image|file|max:1024',
            'deskripsi_gizi' => 'required',
            'youtube_url' => 'required'
        ];

        if ($request->slug != $asupan->slug) {
            $rules['slug'] = 'required|unique:asupans';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image_cover')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image_cover'] = $request->file('image_cover')->store('asupan-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->deskripsi_gizi), 200);

        Asupan::where('id', $asupan->id)
            ->update($validatedData);

        return redirect('/dashboard/asupans')->with('success', 'New asupan gizi has been update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asupan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asupan $asupan)
    {

        if ($asupan->image_cover) {
            Storage::delete($asupan->image_cover);
        }
        Asupan::destroy($asupan->id);

        return redirect('/dashboard/asupans')->with('success', 'asupan has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Asupan::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
