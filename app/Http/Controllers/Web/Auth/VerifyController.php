<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Traits\MyHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    use MyHelper;

    function verify($email)
    {
        $alamat = $this->url_api() . '/auth/verify';
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
                $data = [
                    'icon' => 'success',
                    'msg' => 'Successful Verification'
                ];

                return view('content', $data);
            } else {
                $data = [
                    'icon' => 'error',
                    'msg' => __('messages.terjadi_kesalahan')
                ];

                return view('content', $data);
            }
        } else {
            $data = [
                'icon' => 'error',
                'msg' => __('messages.terjadi_kesalahan')
            ];

            return view('content', $data);
        }
    }
}
