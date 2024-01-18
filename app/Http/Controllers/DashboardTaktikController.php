<?php

namespace App\Http\Controllers;

use App\Models\Taktik;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardTaktikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $taktiks = Taktik::where('user_id', auth()->user()->id)
                        ->when($keyword, function ($query) use ($keyword) {
                            return $query->where('title', 'like', '%'.$keyword.'%');
                        })
                        ->simplePaginate(10);

        $taktiks->withPath('?' . http_build_query($request->query()))
        ->appends(request()->query())
        ->each(function ($item, $index) use ($taktiks) {
            $item->iteration = ($taktiks->currentPage() - 1) * $taktiks->perPage() + $index + 1;
        });

        return view('dashboard.taktiks.index', compact('taktiks'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.taktiks.create', [
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
            'slug' => 'required|unique:taktiks',
            'image_cover' => 'image|file|max:1024',
            'deskripsi' => 'required',
            'youtube_url' => 'required'
        ]);

        if ($request->file('image_cover')) {
            $validateData['image_cover'] = $request->file('image_cover')->store('taktik-images');
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->deskripsi), 200);

        Taktik::create($validateData);

        return redirect('/dashboard/taktiks')->with('success', 'New taktik has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taktik 
     * @return \Illuminate\Http\Response
     */
    public function show(Taktik $taktik)
    {
        $url = $taktik->youtube_url;
        $parsed = parse_url($url);

        if ($parsed['host'] === 'youtu.be') {
            $videoId = ltrim($parsed['path'], '/');
            $taktik->youtube_id = $videoId;
        }

        return view('dashboard.taktiks.show', [
            'taktik' => $taktik
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taktik  
     * @return \Illuminate\Http\Response
     */
    public function edit(Taktik $taktik)
    {
        return view('dashboard.taktiks.edit', [
            'taktik' => $taktik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taktik 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taktik $taktik)
    {
        $rules = [
            'title' => 'required|max:255',
            'image_cover' => 'image|file|max:1024',
            'deskripsi' => 'required',
            'youtube_url' => 'required'
        ];

        if ($request->slug != $taktik->slug) {
            $rules['slug'] = 'required|unique:taktiks';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image_cover')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image_cover'] = $request->file('image_cover')->store('taktik-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->deskripsi), 200);

        Taktik::where('id', $taktik->id)
            ->update($validatedData);

        return redirect('/dashboard/taktiks')->with('success', 'New taktik has been update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taktik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taktik $taktik)
    {

        if ($taktik->image_cover) {
            Storage::delete($taktik->image_cover);
        }
        Taktik::destroy($taktik->id);

        return redirect('/dashboard/taktiks')->with('success', 'taktik has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Taktik::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
