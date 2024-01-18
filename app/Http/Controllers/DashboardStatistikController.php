<?php

namespace App\Http\Controllers;

use App\Models\Statistik;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardStatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $statistiks = Statistik::where('user_id', auth()->user()->id)
                        ->when($keyword, function ($query) use ($keyword) {
                            return $query->where('title', 'like', '%'.$keyword.'%');
                        })
                        ->simplePaginate(10);

        $statistiks->withPath('?' . http_build_query($request->query()))
        ->appends(request()->query())
        ->each(function ($item, $index) use ($statistiks) {
            $item->iteration = ($statistiks->currentPage() - 1) * $statistiks->perPage() + $index + 1;
        });

        return view('dashboard.statistiks.index', compact('statistiks'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.statistiks.create', [
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
            'slug' => 'required|unique:statistiks',
            'rolepemain' => 'required|max:255',
            'image_pemain' => 'image|file|max:1024',
            'speed' => 'required|integer|between:1,100',
            'dribble' => 'required|integer|between:1,100',
            'passing' => 'required|integer|between:1,100',
            'tackles' => 'required|integer|between:1,100',
            'durability' => 'required|integer|between:1,100'
        ]);

        if ($request->file('image_pemain')) {
            $validateData['image_pemain'] = $request->file('image_pemain')->store('pemain-images');
        }

        $validateData['user_id'] = auth()->user()->id;

        Statistik::create($validateData);

        return redirect('/dashboard/statistiks')->with('success', 'New Statistik has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statistik 
     * @return \Illuminate\Http\Response
     */
    public function show(Statistik $statistik)
    {
        return view('dashboard.statistiks.show', [
            'statistik' => $statistik
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statistik  
     * @return \Illuminate\Http\Response
     */
    public function edit(Statistik $statistik)
    {
        return view('dashboard.statistiks.edit', [
            'statistik' => $statistik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Statistik 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statistik $statistik)
    {
        $rules = [
            'title' => 'required|max:255',
            'rolepemain' => 'required|max:255',
            'image_pemain' => 'image|file|max:1024',
            'speed' => 'required|integer|between:1,100',
            'dribble' => 'required|integer|between:1,100',
            'passing' => 'required|integer|between:1,100',
            'tackles' => 'required|integer|between:1,100',
            'durability' => 'required|integer|between:1,100'
        ];

        if ($request->slug != $statistik->slug) {
            $rules['slug'] = 'required|unique:statistiks';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image_pemain')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image_pemain'] = $request->file('image_pemain')->store('pemain-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Statistik::where('id', $statistik->id)
            ->update($validatedData);

        return redirect('/dashboard/statistiks')->with('success', 'New statistik has been update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statistik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statistik $statistik)
    {

        if ($statistik->image_pemain) {
            Storage::delete($statistik->image_pemain);
        }
        Statistik::destroy($statistik->id);

        return redirect('/dashboard/statistiks')->with('success', 'statistik has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Statistik::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
