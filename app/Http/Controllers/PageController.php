<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function show(string $slug)
    {
        return view('pages.placeholder', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
        ]);
    }
}