<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $pelatihans = Pelatihan::where('user_id', auth()->user()->id)
                        ->when($keyword, function ($query) use ($keyword) {
                            return $query->where('title', 'like', '%'.$keyword.'%');
                        })
                        ->simplePaginate(10);

        $pelatihans->withPath('?' . http_build_query($request->query()))
        ->appends(request()->query())
        ->each(function ($item, $index) use ($pelatihans) {
            $item->iteration = ($pelatihans->currentPage() - 1) * $pelatihans->perPage() + $index + 1;
        });

        return view('dashboard.pelatihans.index', compact('pelatihans'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pelatihans.create', [
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
            'slug' => 'required|unique:pelatihans',
            'jenispel' => 'required|max:255',
            'rolepemain' => 'required|max:255',
            'image_cover' => 'image|file|max:1024',
            'deskripsi' => 'required',
            'youtube_url' => 'required'
        ]);

        if ($request->file('image_cover')) {
            $validateData['image_cover'] = $request->file('image_cover')->store('pelatihan-images');
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->deskripsi), 200);

        Pelatihan::create($validateData);

        return redirect('/dashboard/pelatihans')->with('success', 'New pelatihan has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelatihan 
     * @return \Illuminate\Http\Response
     */
    public function show(Pelatihan $pelatihan)
    {
        $url = $pelatihan->youtube_url;
        $parsed = parse_url($url);

        if ($parsed['host'] === 'youtu.be') {
            $videoId = ltrim($parsed['path'], '/');
            $pelatihan->youtube_id = $videoId;
        }

        return view('dashboard.pelatihans.show', [
            'pelatihan' => $pelatihan
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelatihan  
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelatihan $pelatihan)
    {
        return view('dashboard.pelatihans.edit', [
            'pelatihan' => $pelatihan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelatihan 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelatihan $pelatihan)
    {
        $rules = [
            'title' => 'required|max:255',
            'jenispel' => 'required|max:255',
            'rolepemain' => 'required|max:255',
            'image_cover' => 'image|file|max:1024',
            'deskripsi' => 'required',
            'youtube_url' => 'required'
        ];

        if ($request->slug != $pelatihan->slug) {
            $rules['slug'] = 'required|unique:pelatihans';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image_cover')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image_cover'] = $request->file('image_cover')->store('pelatihan-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->deskripsi), 200);

        Pelatihan::where('id', $pelatihan->id)
            ->update($validatedData);

        return redirect('/dashboard/pelatihans')->with('success', 'New pelatihan has been update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelatihan $pelatihan)
    {

        if ($pelatihan->image_cover) {
            Storage::delete($pelatihan->image_cover);
        }
        Pelatihan::destroy($pelatihan->id);

        return redirect('/dashboard/pelatihans')->with('success', 'pelatihan has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pelatihan::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
