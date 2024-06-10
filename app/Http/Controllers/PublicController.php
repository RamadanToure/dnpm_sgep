<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PublicController extends Controller
{

    public function home()
    {
        return view('public.home');
    }
    public function offine()
    {
        return view('public.officine');
    }

    public function industrie()
    {
        return view('public.industrie');
    }

    public function agence()
    {
        return view('public.agence');
    }

    public function officine()
    {
        return view('public.officine');
    }

    public function grossiste()
    {
        return view('public.grossiste');
    }


}
