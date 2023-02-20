@extends('layouts.layout')

@section('content')

@include('modal.modal')

@include('cookie-consent::index')

@if (request()->routeIs('index') || request()->routeIs('client.auth'))

@section('title', config('app.brand'))
@section('description', config('app.description'))
@section('keyword', 'Iban Syahdien Akbar, Ibansyah Olshop, iban syahdien akbar, ibansyah, iban, iban akbar, olshop iban')

@elseif (request()->routeIs('product'))

@section('title', __('messages.product') . ' | ' . config('app.brand'))
@section('description', config('app.description'))
@section('keyword', 'Product Iban Syahdien Akbar, Product Ibansyah Olshop, iban syahdien akbar, ibansyah, iban, iban akbar, olshop iban')

@include('Page.section.product.product')

@elseif (request()->routeIs('product.detail'))

@section('title', __('messages.product') . ' Detail - ' . $product->name . ' | ' . config('app.brand'))
@section('description', config('app.description'))
@section('keyword', 'Product ' . $product->name)

@include('Page.section.product.detail')

@elseif (request()->routeIs('verify'))

@section('title', 'Verify Account' . config('app.brand'))
@section('description', 'Verify Account - ' . config('app.description'))
@section('keyword', 'verify account')

<script type="text/javascript">
    Swal.fire({
        icon: '{{ $icon }}'
        , title: '{{ $msg }}'
        , showConfirmButton: false
        , timer: 1500
        , willClose: () => {
            window.close();
        }
        , allowOutsideClick: false
        , allowEscapeKey: false
    })

</script>

@elseif (request()->routeIs('reset'))

@section('title', 'Reset Password | ' . config('app.brand'))
@section('description', 'Reset Password - ' . config('app.description'))
@section('keyword', 'reset password')

@if ($status == true)
@include('Page.section.reset.reset')
@else
<script type="text/javascript">
    Swal.fire({
        icon: 'error'
        , title: '{{ $msg }}'
        , showConfirmButton: false
        , timer: 1500
        , willClose: () => {
            window.close();
        }
        , allowOutsideClick: false
        , allowEscapeKey: false
    })

</script>
@endif

@elseif (request()->routeIs('errors'))

@section('title', 'Error | ' . config('app.brand'))
@section('description', 'Error')
@section('keyword', 'error ' . config('app.brand'))
<script type="text/javascript">
    setTimeout(() => {
        window.close();
    }, 2500);

</script>
@endif


@endsection
