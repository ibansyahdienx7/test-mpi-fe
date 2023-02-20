<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Traits\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    use MyHelper;

    function index()
    {
        return view('content');
    }

    function sign(LoginRequest $request)
    {
        try {
            $email = $request->email;
            $password = $request->password;

            $identity = User::where(
                'email',
                $email
            )->first();

            if ($identity->status == 0) {
                return redirect(route('index'))->with('info', __('messages.pengguna_non_aktif'));
            }

            if (!Hash::check($password, $identity->password)) :
                return Redirect::back()->with('error', __('messages.kata_sandi_tidak_cocok'));
            endif;

            if ($identity && Auth::attempt(['email' => $email, 'password' => $request->password])) {
                $request->session()->regenerate();

                return redirect()->intended(route('client.auth'));
            } else {
                return Redirect::back()->with('error', __('messages.pengguna_tidak_ditemukan'));
            }
        } catch (HttpException $e) {
            return redirect(route('index'))->with('info', $e->getstatusCode() . ' | ' . $e->getMessage());
        }
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect(route('login.guest'));
    }
}
