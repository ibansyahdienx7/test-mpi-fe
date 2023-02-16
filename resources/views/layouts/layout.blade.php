<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
        {{-- @vite(['resources/css/app.css']) --}}
        @viteReactRefresh
        @routes
    </head>

    <body>
        <div id="app">

            @include('Flash.flash')

            @if (!request()->routeIs('portfolio.detail'))
                @include('Page.section.header.header')
                @if(request()->routeIs('index'))
                    @include('Page.section.banner.banner')
                @endif
            @endif

            <main id="main" class="mt-5 mb-5">
                <!-- CONTENT -->
                @yield('content')
                <!-- // CONTENT // -->
            </main>

            @if (!request()->routeIs('portfolio.detail'))
                @include('Page.section.footer.footer')
            @endif

            @include('Page.script.script_search')
            @include('Page.script.script')
            {{-- @include('Page.script.script_drivertour') --}}

        </div>
    </body>

</html>
