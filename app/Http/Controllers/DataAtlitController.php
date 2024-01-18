<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistik;
use App\Models\User;


class DataAtlitController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $statistiks = Statistik::latest()-> paginate(3)->withQueryString();

        return view('datapemains', [
            "active" => 'taktiks',
            "statistiks" => $statistiks,
        ]);
    }

    public function show(Statistik $statistik)
    {
        return view('statistik', [
            "statistik" => $statistik
        ]);
    }
}
