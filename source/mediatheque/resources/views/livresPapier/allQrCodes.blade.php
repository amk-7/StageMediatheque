
<html>
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Icon -->
        <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('storage/images/logo2.png') }}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="flex flex-col justify-center items-center m-auto">
            <h1 class="label_title">Cotes ouvrages</h1>
            <input type="button" class="button button_show" name="export" value="Imprimer" id="cotes_pdf" onclick="Convert_HTML_To_PDF()">
            <div class="ml-16 m-auto mb-12">
                <table id="cotes">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($livresPapiers as $livresPapier)
                        <tr>
                            <td>
                                <div class="border-4 border-black border-dashed p-3 bg-white">
                                    <image src='data:image/png;base64, {{ base64_encode(QrCode::size(300)->format('png')->generate($livresPapier->ouvragesPhysique->cote)) }}'/>
                                </div>
                            </td>
                            <td>
                            <span class="ml-3 text-center flex flex-col items-center">
                                <span>{{ $livresPapier->ouvragesPhysique->ouvrage->titre }}</span>
                                <span>{{ $livresPapier->ouvragesPhysique->cote }}</span>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

