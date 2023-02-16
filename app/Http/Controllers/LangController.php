<?php

namespace App\Http\Controllers;

use App\Models\TbSubscribe;
use App\Models\TbSubscribeModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use App\Traits\MyHelper;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent as Agent;
use Illuminate\Support\Facades\Mail;
use App\Mail\AyoMail;
use App\Models\TbContact;

class LangController extends Controller
{

    use MyHelper;

    function changeLang($locale){
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }


}
