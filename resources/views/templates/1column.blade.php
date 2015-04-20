<html>
    <head>
        <!-- references to css -->
        @include('partials.css')

    </head>

    <body>

        </br>

        <div class="ui page grid">

                @include('partials.menu')

                @yield('content')

            </div>

        <!-- activate the semantic elements -->

        @include('partials.js')

        @yield('dTScript')
    </body>
</html>