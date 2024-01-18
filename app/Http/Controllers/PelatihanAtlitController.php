<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taktik;
use App\Models\Pelatihan;
use App\Models\Asupan;
use App\Models\User;

class PelatihanAtlitController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $taktiks = Taktik::latest()-> paginate(3)->withQueryString();
        $pelatihans = Pelatihan::latest()-> paginate(3)->withQueryString();
        $asupans = Asupan::latest()-> paginate(3)->withQueryString();
        // where('title','like','%'.$keyword.'%')->
        return view('pelatihans', [
            "active" => 'taktiks',
            "taktiks" => $taktiks,
            "pelatihans" => $pelatihans,
            "asupans" => $asupans
        ]);
    }

    public function show(Taktik $taktik)
    {
        $url = $taktik->youtube_url;
        $parsed = parse_url($url);

        if ($parsed['host'] === 'youtu.be') {
            $videoId = ltrim($parsed['path'], '/');
            $taktik->youtube_id = $videoId;
        }

        return view('taktik', [
            "taktik" => $taktik
        ]);
    }

    public function showpelatihan(Pelatihan $pelatihan)
    {
        $url = $pelatihan->youtube_url;
        $parsed = parse_url($url);

        if ($parsed['host'] === 'youtu.be') {
            $videoId = ltrim($parsed['path'], '/');
            $pelatihan->youtube_id = $videoId;
        }

        return view('pelatihan', [
            "pelatihan" => $pelatihan
        ]);
    }

    public function showasupan(Asupan $asupan)
    {
        $url = $asupan->youtube_url;
        $parsed = parse_url($url);

        if ($parsed['host'] === 'youtu.be') {
            $videoId = ltrim($parsed['path'], '/');
            $asupan->youtube_id = $videoId;
        }

        return view('asupan', [
            "asupan" => $asupan
        ]);
    }
}
