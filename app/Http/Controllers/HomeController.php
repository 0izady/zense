<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PHPUnit\TextUI\Application;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $historys = History::where('user_id', Auth::id())->get();
        }else {
            $historys = ["برای تاریخچه جستوجو باید اول وارد سایت بشی"];
        }

        return Inertia::render('Welcome', [
            'canLogin' => \Illuminate\Support\Facades\Route::has('login'),
            'canRegister' => \Illuminate\Support\Facades\Route::has('register'),
            'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
            'phpVersion' => PHP_VERSION,
            "historys" => $historys
        ]);
    }
}

