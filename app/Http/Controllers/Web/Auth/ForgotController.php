<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Traits\MyHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    use MyHelper;

    function forgotPost()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect(route('index'))->with('info', '422 Bad Request | ' . $validator->errors());
        }

        try {
            $email = Str::lower(request()->email);
            $alamat = $this->url_api() . '/auth/forgot';
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $client = new Client([
                'headers' => $headers
            ]);

            $request = $client->request('POST', $alamat, [
                'form_params' => [
                    'email' => $email
                ]
            ]);

            $response = $request->getBody()->getContents();
            $response = json_decode($response);
            if ($response) {
                if ($response->status == true) {
                    return Redirect::back()->with('success', __('messages.forgot_success'));
                } else {
                    return Redirect::back()->with('success', __('messages.terjadi_kesalahan'));
                }
            } else {
                return Redirect::back()->with('success', __('messages.terjadi_kesalahan'));
            }
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $rbody = $response->getReasonPhrase();
            $rcode = $exception->getCode();

            return redirect(route('index'))->with('info', $rcode . ' | ' . $rbody);
        }
    }
    function reset($token)
    {
        $alamat = $this->url_api() . '/auth/check-reset';
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'headers' => $headers
        ]);

        $request = $client->request('POST', $alamat, [
            'form_params' => [
                'token' => $token
            ]
        ]);

        $response = $request->getBody()->getContents();
        $response = json_decode($response);
        if ($response) {
            if ($response->status == true) {
                $data = [
                    'status' => true,
                    'user' => $response->data,
                ];

                return view('content', $data);
            } else {
                $data = [
                    'status' => false,
                    'msg' => __('messages.notfound')
                ];

                return view('content', $data);
            }
        } else {
            $data = [
                'status' => false,
                'msg' => __('messages.terjadi_kesalahan')
            ];

            return view('content', $data);
        }
    }

    function resetPost()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('index'))->with('info', '422 Bad Request | ' . $validator->errors());
        }

        try {
            $email = Str::lower(request()->email);
            $password = request()->password;
            $alamat = $this->url_api() . '/auth/reset-confirm';
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $client = new Client([
                'headers' => $headers
            ]);

            $request = $client->request('POST', $alamat, [
                'form_params' => [
                    'email' => $email,
                    'new_password' => $password
                ]
            ]);

            $response = $request->getBody()->getContents();
            $response = json_decode($response);
            if ($response) {
                if ($response->status == true) {
                    return redirect(route('index'))->with('success', __('messages.reset_success'));
                } else {
                    return redirect(route('index'))->with('info', __('messages.terjadi_kesalahan'));
                }
            } else {
                return redirect(route('index'))->with('info', __('messages.terjadi_kesalahan'));
            }
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $rbody = $response->getReasonPhrase();
            $rcode = $exception->getCode();

            return redirect(route('index'))->with('info', $rcode . ' | ' . $rbody);
        }
    }
}
