<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pengepul.{$page}")) {
            return view("pengepul.{$page}");
        }

        return abort(404);
    }

    public function admin(string $page)
    {
        if (view()->exists("admin.{$page}")) {
            return view("admin.{$page}");
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pengepul.virtual-reality");
    }

    public function rtl()
    {
        return view("pengepul.rtl");
    }

    public function profile()
    {
        return view("pengepul.profile-static");
    }

    public function signin()
    {
        return view("pengepul.sign-in-static");
    }

    public function signup()
    {
        return view("pengepul.sign-up-static");
    }
}
