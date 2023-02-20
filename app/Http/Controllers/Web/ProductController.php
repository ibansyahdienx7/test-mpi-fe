<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Traits\MyHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use MyHelper;

    function listProduct()
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
                $status = true;
                $resultCategory = '';
                $resultCategory .= '
                <div class="row justify-center">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters" class="filters">
                            <li data-filter="*" class="filter-active text-uppercase">' . __('messages.semua') . '</li>
                ';
                foreach ($response->data as $c) {
                    $alamat_category = $this->url_api() . '/category/list/' . $c->id_category;
                    $client_category = new Client([
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json'
                        ]
                    ]);
                    $request_category = $client_category->request('GET', $alamat_category);
                    $response_category = $request_category->getBody()->getContents();
                    $response_category = json_decode($response_category);

                    if ($response_category) {
                        if ($response_category->status == true) {
                            $resultCategory .= '
                                <li data-filter=".filter-' . $response_category->data->id . '" class=" text-uppercase">' . $response_category->data->name . '</li>
                            ';
                        }
                    }
                }

                $resultCategory .= '
                        </ul>
                    </div>
                </div>
                ';

                $result = '';
                $result .= '<div class="row justify-content-center justify-center portfolio-container">';
                foreach ($response->data as $p) {
                    if ($p->discount !== 0) {
                        $discount = '
                        <p class=" badge bg-danger">
                            ' . $p->discount . '%
                        </p>
                        ';
                        $harga = '
                        <p class="">
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
                        <p class="">
                            ' . $this->mataUang() . ' ' . number_format($p->real_price, 0, '.', '.') . '
                        </p>
                        ';
                    }

                    $result .= '
                    <div class="col-lg-4 col-md-6 portfolio-item filter-' . $p->id_category . '">
                        <center>
                        <img src="' . $p->photo . '" class="img-fluid" alt="' . $p->name . '" title="' . $p->name . '" />
                        </center>
                        <div class="portfolio-info">
                            <h4 class="text-left">' . $p->name . '</h4>
                            <p>
                                ' . $discount . '
                                ' . $harga . '
                            </p>
                            <a href="' . $p->photo . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="' . $p->name . '"><i class="bx bx-zoom-in"></i></a>
                            <a href="' . route('product.detail', $p->slug) . '" class="details-link" title="More Details - ' . $p->name . '"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                    ';
                }
                $result .= '</div>';
            } else {
                $status = false;
                $resultCategory = NULL;
                $result = NULL;
            }
        } else {
            $status = false;
            $resultCategory = NULL;
            $result = NULL;
        }

        $data = [
            'status' => $status,
            'resultCategory' => $resultCategory,
            'result' => $result
        ];

        return $data;
    }
    function index()
    {
        $data = $this->listProduct();

        return view('content', $data);
    }

    function detail($slug)
    {
        $tr = new GoogleTranslate();
        $alamat = $this->url_api() . '/product/' . $slug;
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
                $alamat_category = $this->url_api() . '/category/list/' . $response->data->product->id_category;
                $client_category = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                    ]
                ]);
                $request_category = $client_category->request('GET', $alamat_category);
                $response_category = $request_category->getBody()->getContents();
                $response_category = json_decode($response_category);

                if ($response_category) {
                    if ($response_category->status == true) {
                        if (str_replace('_', '-', app()->getLocale()) == 'id') {
                            $name_ctg = $response_category->data->name;
                        } else {
                            $name_ctg = $tr->setTarget('en')->translate($response_category->data->name);
                        }
                        $ctg = $name_ctg;
                    } else {
                        $ctg = 'Unknown';
                    }
                    $category = $ctg;
                } else {
                    $category = 'Unknown';
                }

                $explode_size = explode(',', $response->data->product->size);
                $explode_variant = explode(',', $response->data->product->variant);

                $result_size = '';
                foreach ($explode_size as $s => $key_size) {
                    $result_size .= '<span class="badge bg-primary mr-2">' . $key_size . '</span>';
                }

                $result_variant = '';
                foreach ($explode_variant as $v => $key_variant) {
                    $result_variant .= '<span class="badge bg-dark mr-2">' . $key_variant . '</span>';
                }

                if ($response->data->product->discount !== 0) {
                    $discount = '
                    <label class=" badge bg-danger">
                        ' . $response->data->product->discount . '%
                    </label>
                    ';
                    $harga = '
                    <label class="">
                        <span style="text-decoration: line-through;" class="text-muted">
                            ' . $this->mataUang() . ' ' . number_format($response->data->product->price, 0, '.', '.') . '
                        </span>
                        &nbsp;
                        ' . $this->mataUang() . ' ' . number_format($response->data->product->real_price, 0, '.', '.') . '
                    </label>
                    ';
                } else {
                    $discount = '
                    <label class=" badge bg-dark">
                        ' . $response->data->product->discount . '%
                    </label>
                    ';
                    $harga = '
                    <label class="">
                        ' . $this->mataUang() . ' ' . number_format($response->data->product->real_price, 0, '.', '.') . '
                    </label>
                    ';
                }

                if (str_replace('_', '-', app()->getLocale()) == 'id') {
                    $note = Str::replace("\n\n", "<br/><br/>", $response->data->product->note_product);
                } else {
                    $note = $tr->setTarget('en')->translate(Str::replace("\n\n", "<br/><br/>", $response->data->product->note_product));
                }

                if (str_replace('_', '-', app()->getLocale()) == 'id') {
                    $description_product = Str::replace("\n\n", "<br/><br/>", $response->data->product->description_product);
                } else {
                    $description_product = $tr->setTarget('en')->translate(Str::replace("\n\n", "<br/><br/>", $response->data->product->description_product));
                }

                $data = [
                    'note' => $note,
                    'description_product' => $description_product,
                    'discount' => $discount,
                    'harga' => $harga,
                    'result_size' => $result_size,
                    'result_variant' => $result_variant,
                    'category' => $category,
                    'product' => $response->data->product,
                    'review' => $response->data->review,
                ];

                return view('content', $data);
            } else {
                return Redirect::back()->with('error', __('messages.product_not_found'));
            }
        } else {
            return Redirect::back()->with('error', __('messages.product_not_found'));
        }
    }
}
