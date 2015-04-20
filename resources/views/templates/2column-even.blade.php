<html>
<head>
    <!-- references to css -->
    @include('partials.css')

</head>

<body>

</br>

<div class="ui page grid">

    @include('partials.menu')

    @yield('header')

    <div class="eight wide column">
        @yield('left-content')
    </div>

    <div class="eight wide column">
        @yield('right-content')
    </div>

    @yield('modals')

</div>

<!-- activate the semantic elements -->

@include('partials.js')

@yield('extrajs')

</body>
</html>