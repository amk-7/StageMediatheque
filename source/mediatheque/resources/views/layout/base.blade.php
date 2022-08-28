<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--link href="/css/app.css" rel="stylesheet"-->
    <title>enregister un ouvrage</title>
    @yield("livewire_style_content")
    @yield("style")
    <style>
        .alert {
            background: red;
        }
    </style>
</head>
<body>
    <header>
    </header>
    @yield('content')
    @yield("load_json_data")
    @yield("livewire_script_content")
    <footer>
    </footer>
</body>
</html>
