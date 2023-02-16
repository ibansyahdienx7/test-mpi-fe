<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Traits\MyHelper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use MyHelper;

    function Home()
    {
        return view('content');
    }
}
