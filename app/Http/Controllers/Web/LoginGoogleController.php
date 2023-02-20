<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\MyHelper;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginGoogleController extends Controller
{
    use MyHelper;

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {

                if ($finduser->status == 10) {
                    $finduser->update([
                        'profile_photo_path' => $user->avatar,
                    ]);

                    Auth::login($finduser);

                    return redirect()->intended(route('client.auth'));
                } else {
                    return redirect(route('index'))->with('info', __('messages.pengguna_non_aktif'));
                }
            } else {

                $alamat = $this->url_api() . '/auth/register';
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                    ]
                ]);
                $request = $client->request('POST', $alamat, [
                    'form_params' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $this->unix_time()
                    ]
                ]);
                $response = $request->getBody()->getContents();
                $response = json_decode($response);
                if ($response) {
                    if ($response->status == true) {
                        $cek_user = User::where('email', $response->data->email)->first();
                        if (empty($cek_user)) {
                            return redirect(route('index'))->with('info', __('messages.regist_manual'));
                        }

                        $cek_user->update([
                            'profile_photo_path' => $user->avatar,
                        ]);

                        // Auth::login($cek_user);

                        // return redirect()->intended('home');
                        return redirect(route('index'))->with('info', __('messages.verifikasi'));
                    } else {
                        return redirect(route('index'))->with('info', __('messages.terjadi_kesalahan'));
                    }
                } else {
                    return redirect(route('index'))->with('info', __('messages.terjadi_kesalahan'));
                }
            }
        } catch (HttpException $e) {
            return redirect(route('index'))->with('info', $e->getstatusCode() . ' | ' . $e->getMessage());
        }
    }
}
