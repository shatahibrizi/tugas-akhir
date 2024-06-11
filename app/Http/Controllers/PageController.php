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

        if (view()->exists("admin.{$page}")) {
            return view("admin.{$page}");
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
}
