@extends('layouts.layout')

@section('content')

@include('modal.modal')

@if (!request()->routeIs('portfolio.detail'))
@include('Page.chat_widget.chat')
@endif

@include('cookie-consent::index')

@if (request()->routeIs('index'))

@section('title', config('app.brand'))
@section('description', config('app.description'))
@section('keyword', 'Iban Syahdien Akbar, Iban Portfolio, iban syahdien akbar, ibansyah, iban, iban akbar, portfolio iban')

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
    })

</script>

@elseif (request()->routeIs('errors'))

@section('title', 'Error' . config('app.brand'))
@section('description', 'Error')
@section('keyword', 'error ' . config('app.brand'))
<script type="text/javascript">
    setTimeout(() => {
        window.close();
    }, 2500);

</script>
@endif


@endsection
