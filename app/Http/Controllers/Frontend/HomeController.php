<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Web Serveces'
        ];

        return view('front-end.index', $data);
    }
}