<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
    @viteReactRefresh
    @routes
</head>

<body>
    <div id="app">

        @include('Flash.flash')

        @include('Page.section.header.header')
        @if(request()->routeIs('index') || request()->routeIs('client.auth'))
        @include('Page.section.banner.banner')
        @endif

        <main id="main" class="mt-5 mb-5">
            <!-- CONTENT -->
            @yield('content')
            <!-- // CONTENT // -->
        </main>

        @include('Page.section.footer.footer')

        @include('Page.script.script_search')
        @include('Page.script.script')
        {{-- @include('Page.script.script_drivertour') --}}

    </div>
</body>

</html>
