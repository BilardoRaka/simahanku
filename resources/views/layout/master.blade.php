<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Simahanku">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Simahanku">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/nifandatama.png') }}">
    <!-- Page Title  -->
    <title>Simahanku | @yield('title')</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.1.0') }}">
    <!-- tinyMCE -->
    <script src="{!! url('assets/js/tinymce/tinymce.min.js') !!}"></script>
    @yield('style')
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @include('layout.sidebar')
            <!-- wrap @s -->
            <div class="nk-wrap ">
                @include('layout.header')
                @yield('content')
                @include('layout.footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bundle.js?ver=3.1.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.1.0') }}"></script>
    <script src="{{ asset('assets/js/charts/gd-default.js?ver=3.1.0') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    function validateNumber(evt) {
        var e = evt || window.event;
        var key = e.keyCode || e.which;

        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
            // numbers   
            key >= 48 && key <= 57 ||
            // Numeric keypad
            key >= 96 && key <= 105 ||
            // Backspace and Tab and Enter
            key == 8 || key == 9 || key == 13 ||
            // Home and End
            key == 35 || key == 36 ||
            // left and right arrows
            key == 37 || key == 39 ||
            // Del and Ins
            key == 46 || key == 45) {
            // input is VALID
        } else {
            e.returnValue = false;
            if (e.preventDefault) e.preventDefault();
        }
    }
    </script>
    @yield('script')
</body>

</html>