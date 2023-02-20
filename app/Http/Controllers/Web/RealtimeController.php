<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Traits\MyHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stichoza\GoogleTranslate\GoogleTranslate;

class RealtimeController extends Controller
{
    use MyHelper;

    function RealtimeFooter()
    {
        // ABOUT IBAN //
        $tr = new GoogleTranslate();

        $resume = $this->resume();

        if ($resume['status'] == true) {
            if (str_replace('_', '-', app()->getLocale()) == 'id') {
                $abouts = str_replace("\n\n", "<br/><br/>", $resume['data']->summary);
            } else {
                $abouts = $tr->setTarget('en')->translate(str_replace("\n\n", "<br/><br/>", $resume['data']->summary));
            }

            $about = '
            <div class="full-width p-0 m-0">
                <div class="page-width p-0 m-0">
                    <div class="expander p-0 m-0 foot">
                        <div class="inner-bit p-0 m-0">
                            <p class="text-left p-0 m-0">
                                ' . $abouts . '
                            </p>
                        </div>
                    </div>
                    <button class="button expand-toggle foot mt-3 mb-3" href="javascript:void(0)">
                        ' . __('messages.tampilkan_lebih_banyak') . '
                    </button>
                </div>
            </div>
            ';
        } else {
            $about = '
                Website :
                <a href="https://ibansyah.pesanin.com/" target="_blank">
                https://ibansyah.pesanin.com/
                </a>
            ';
        }

        // PAYMENT GATEWAY //
        $payment = $this->paymetnGateway();
        if ($payment['status'] == true) {
            $status_payment = true;
            $result_payment = $payment['result'];
        } else {
            $status_payment = false;
            $result_payment = NULL;
        }

        $data = [
            'abouts' => $about,
            'status_payment' => $status_payment,
            'result_payment' => $result_payment
        ];

        return response()->json($data, 200);
    }

    function RealTimeCart()
    {
        $result = '';
        $result .= '
        <div id="team" class="team">
            <div class="container" data-aos="fade-up">
                <div class="row">
        ';

        if (auth()->user()) {
            $alamat = $this->url_api() . '/cart/list/' . auth()->user()->id;
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);
            $request = $client->request('GET', $alamat);
            $response = $request->getBody()->getContents();
            $response = json_decode($response);
            if ($response) {
                if ($response->status == true) {
                    foreach ($response->data as $c) {
                        $size = explode(',', $c->size);
                        $variant = explode(',', $c->variant);

                        $result_size = '';
                        $result_size .= '<ul class="size-cart">';
                        $result_size .= '<li class="text-dark">' . __('messages.ukuran') . ' : </li><br/>';
                        foreach ($size as $s => $key) {
                            if ($c->cart_size_product) {
                                if ($key == $c->cart_size_product) {
                                    $option_size = 'active';
                                } else {
                                    $option_size = '';
                                }

                                $option_sizes = $option_size;
                            } else {
                                $option_sizes = '';
                            }
                            $result_size .= '
                                <li class="bg-size ' . $option_sizes . ' rounded p-2" id="size-' . str_replace(" ", "", $key) . '_' . $c->id_cart . '">
                                    ' . str_replace(" ", "", $key) . '
                                </li>
                                <input type="hidden" value="' . str_replace(" ", "", $key) . '" id="size-check_' . str_replace(" ", "", $key) . '_' . $c->id_cart . '" readonly />
                                <script type="text/javascript">
                                    $("#size-' . str_replace(" ", "", $key) . '_' . $c->id_cart . '").on("click", function(){
                                        if($("#size-check_' . str_replace(" ", "", $key) . '_' . $c->id_cart . '").val() == "' . str_replace(" ", "", $key) . '")
                                        {
                                            $(this).addClass("active").removeClass("active");
                                        } else {
                                            $(this).addClass("active");
                                        }
                                        $("#valuesize_' . $c->id_cart . '").val("' . str_replace(" ", "", $key) . '");
                                    });
                                </script>
                            ';
                        }
                        $result_size .= '</ul>';

                        $result_variant = '';
                        $result_variant .= '<ul class="variant-cart">';
                        $result_variant .= '<li class="text-dark">Variant : </li><br/>';
                        foreach ($variant as $v => $key_variant) {
                            if ($c->cart_variant_product) {
                                if ($key_variant == $c->cart_variant_product) {
                                    $option_variant = 'active';
                                } else {
                                    $option_variant = '';
                                }

                                $option_variants = $option_variant;
                            } else {
                                $option_variants = '';
                            }
                            $result_variant .= '
                                <li class="bg-variant ' . $option_variants . ' rounded p-2" id="variant-' . str_replace(" ", "", $key_variant) . '_' . $c->id_cart . '">
                                    ' . str_replace(" ", "", $key_variant) . '
                                </li>

                                <input type="hidden" value="' . str_replace(" ", "", $key_variant) . '" id="variant-check_' . str_replace(" ", "", $key_variant) . '_' . $c->id_cart . '" readonly />

                                <script type="text/javascript">
                                    $("#variant-' . str_replace(" ", "", $key_variant) . '_' . $c->id_cart . '").on("click", function(){
                                        if($("#variant-check_' . str_replace(" ", "", $key_variant) . '_' . $c->id_cart . '").val() == "' . str_replace(" ", "", $key_variant) . '")
                                        {
                                            $(this).addClass("active");
                                        } else {
                                            $(this).removeClass("active");
                                        }
                                        $("#valuevariant_' . $c->id_cart . '").val("' . str_replace(" ", "", $key_variant) . '");
                                    });
                                </script>
                            ';
                        }
                        $result_variant .= '</ul>';

                        if ($c->discount !== 0) {
                            $discount = $c->discount;
                        } else {
                            $discount = $c->discount;
                        }

                        if ($c->cart_size_product) {
                            $sizes = $c->cart_size_product;
                        } else {
                            $sizes = NULL;
                        }

                        if ($c->cart_variant_product) {
                            $variants = $c->cart_variant_product;
                        } else {
                            $variants = NULL;
                        }
                        $result .= '
                        <div class="col-lg-6 mb-3 p-2" data-aos="fade-up" data-aos-delay="100">
                            <div class="member d-flex align-items-start p-2">
                                <div class="pic">
                                    <img src="' . $c->photo . '" class="img-fluid" alt="' . $c->name . '" title="' . $c->name . '" />
                                </div>
                                <div class="member-info">
                                    <h4>' . $c->name . '</h4>
                                    <label>
                                        <div class="d-flex">
                                            <img src="' . $c->photo_store . '" class="rounded-full mr-2 w-10" alt="' . $c->name_store . '" title="' . $c->name_store . '" />
                                            <span class="mt-2">' . $c->name_store . '</span>
                                        </div>
                                    </label>
                                    <div class="social p-2">
                                        <a href="#">' . $discount . '<i class="ri-percent-line"></i></a>
                                    </div>
                                    <p>
                                        ' . $result_size . '
                                    </p>
                                    <p>
                                        ' . $result_variant . '
                                    </p>
                                    <input type="hidden" name="user_id[]" value="' . auth()->user()->id . '" class="form-control" readonly />
                                    <input type="hidden" name="id_product[]" value="' . $c->id_product . '" class="form-control" readonly />
                                    <input type="hidden" name="name_product[]" value="' . $c->name . '" class="form-control" readonly />
                                    <input type="hidden" name="name_store[]" value="' . $c->name_store . '" class="form-control" readonly />
                                    <input type="hidden" name="photo_store[]" value="' . $c->photo_store . '" class="form-control" readonly />
                                    <input type="hidden" name="photo[]" value="' . $c->photo . '" class="form-control" readonly />
                                    <input type="hidden" name="price[]" value="' . $c->price . '" class="form-control" readonly />
                                    <input type="hidden" name="discount[]" value="' . $c->discount . '" class="form-control" readonly />
                                    <input type="hidden" name="real_price[]" value="' . $c->real_price . '" class="form-control" readonly />
                                    <input type="hidden" name="slug[]" value="' . $c->slug . '" class="form-control" readonly />

                                    <input type="hidden" name="size[]" id="valuesize_' . $c->id_cart . '" value="' . $sizes . '" class="form-control" readonly required />

                                    <input type="hidden" name="variant[]" id="valuevariant_' . $c->id_cart . '" value="' . $sizes . '" class="form-control" readonly required />
                                </div>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    $result .= '
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="member d-flex align-items-start">
                            <div class="pic">
                                <img src="https://4.bp.blogspot.com/-GZEA28juPQ4/Urrv36Bp-4I/AAAAAAAAAOk/InvzgxJCr3s/s1600/error.png" class="img-fluid" alt="' . __('messages.terjadi_kesalahan') . '" title="' . __('messages.terjadi_kesalahan') . '" />
                            </div>
                            <div class="member-info mt-5" align="center">
                                <h4>' . __('messages.terjadi_kesalahan') . '</h4>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                $result .= '
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="member d-flex align-items-start">
                        <div class="pic">
                            <img src="https://4.bp.blogspot.com/-GZEA28juPQ4/Urrv36Bp-4I/AAAAAAAAAOk/InvzgxJCr3s/s1600/error.png" class="img-fluid" alt="' . __('messages.terjadi_kesalahan') . '" title="' . __('messages.terjadi_kesalahan') . '" />
                        </div>
                        <div class="member-info mt-5" align="center">
                            <h4>' . __('messages.terjadi_kesalahan') . '</h4>
                        </div>
                    </div>
                </div>
                ';
            }
        } else {
            $result .= '
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                <div class="member d-flex align-items-start">
                    <div class="pic">
                        <img src="https://img.freepik.com/free-vector/flat-design-cafe-enter-sign_23-2149276119.jpg?w=2000" class="img-fluid" alt="' . __('messages.login_dahulu') . '" title="' . __('messages.login_dahulu') . '" />
                    </div>
                    <div class="member-info mt-5" align="center">
                        <h4 class="text-center">' . __('messages.login_dahulu') . ' ....</h4>
                    </div>
                </div>
            </div>
            ';
        }

        $result .= '
                    </div>
                </div>
            </div>
        ';

        $data = [
            'result' => $result
        ];

        return response()->json($data, 200);
    }

    function RealTimeBanner()
    {
        $alamat = $this->url_api() . '/product/list';
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        $request = $client->request('GET', $alamat);
        $response = $request->getBody()->getContents();
        $response = json_decode($response);

        if ($response) {
            if ($response->status == true) {
                $result = '';
                foreach ($response->data as $p) {
                    if ($p->id_product == 1) {
                        $set_active = 'active';
                    } else {
                        $set_active = '';
                    }

                    if (auth()->user()) {
                        if (auth()->user()->id == $p->id_user) {
                            $classes = 'd-none';
                        } else {
                            $classes = '';
                        }

                        $hiden = $classes;
                    } else {
                        $hiden = '';
                    }

                    if ($p->discount !== 0) {
                        $discount = '
                        <p class="animate__animated animate__fadeInUp badge bg-danger">
                            ' . $p->discount . '%
                        </p>
                        ';
                        $harga = '
                        <p class="animate__animated animate__fadeInUp">
                            <span style="text-decoration: line-through;" class="text-muted">
                                ' . $this->mataUang() . ' ' . number_format($p->price, 0, '.', '.') . '
                            </span>
                            &nbsp;
                            ' . $this->mataUang() . ' ' . number_format($p->real_price, 0, '.', '.') . '
                        </p>
                        ';
                    } else {
                        $discount = '';
                        $harga = '
                        <p class="animate__animated animate__fadeInUp">
                            ' . $this->mataUang() . ' ' . number_format($p->real_price, 0, '.', '.') . '
                        </p>
                        ';
                    }

                    $result .= '
                    <div class="carousel-item ' . $set_active . '">
                        <div class="carousel-container">
                            <h2 class="animate__animated animate__fadeInDown text-center">
                                <center>
                                    <img src="' . $p->photo . '" class="img-fluid" alt="' . $p->name . '" title="' . $p->name . '" />
                                </center>
                            </h2>
                            <p class="animate__animated animate__fadeInUp">
                                ' . $p->name . '
                            </p>
                            ' . $discount . '
                            ' . $harga . '
                            <a href="' . route('product.detail', $p->slug) . '" class="' . $hiden . ' btn-get-started animate__animated animate__fadeInUp">
                                ' . __('messages.lihat_detail') . '
                            </a>
                        </div>
                    </div>
                    ';
                }
            } else {
                $result = '
                <div class="carousel-item active">
                    <div class="carousel-container">
                        <h2 class="animate__animated animate__fadeInDown">' . __('messages.welcome') . ' <span>' . config('app.brand') . '</h2>
                        <p class="animate__animated animate__fadeInUp"></p>
                        <a href="' . route('product') . '" class="btn-get-started animate__animated animate__fadeInUp">
                            ' . __('messages.mulai_belanja') . '
                        </a>
                    </div>
                </div>
                ';
            }
        } else {
            $result = '
                <div class="carousel-item active">
                    <div class="carousel-container">
                        <h2 class="animate__animated animate__fadeInDown">' . __('messages.welcome') . ' <span>' . config('app.brand') . '</h2>
                        <p class="animate__animated animate__fadeInUp"></p>
                        <a href="' . route('product') . '" class="btn-get-started animate__animated animate__fadeInUp">
                            ' . __('messages.mulai_belanja') . '
                        </a>
                    </div>
                </div>
                ';
        }

        $data = [
            'result' => $result
        ];

        return response()->json($data, 200);
    }

    function RealTimeSubscribe()
    {
        $email = request()->email;
        $ip = $this->userAgentIp();

        $alamat = $this->url_api() . '/subscribe/store';
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        $request = $client->request('POST', $alamat, [
            'form_params' => [
                'email' => $email,
                'ip' => $ip
            ]
        ]);
        $response = $request->getBody()->getContents();
        $response = json_decode($response);

        if ($response) {
            if ($response->status == true) {
                return Redirect::back()->with('success', __('messages.subscribe_success'));
            } else {
                return Redirect::back()->with('info', __('messages.data_tersedia'));
            }
        } else {
            return Redirect::back()->with('info', __('messages.data_tersedia'));
        }
    }
}
