<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script-->
    <!--link href="/css/app.css" rel="stylesheet"-->
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" async></script-->
    <title>{{ $page_titre ?? "Aucun titre" }}</title>
    @yield("livewire_styles_content")
</head>
<body class="bg-gray-200">
    <header>
    </header>
    @yield('content')
    @yield("livewire_scripts_content")
    <footer>
    </footer>
    @yield("js")
</body>
</html>
