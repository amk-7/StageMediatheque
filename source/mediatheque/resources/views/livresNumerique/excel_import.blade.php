@extends('layout.template.base')
@section('content')
    <form action="{{ route('enregistrementImportExcelLivresNumerique') }}" method="post" enctype="multipart/form-data" class="m-auto flex flex-col space-y-3">
        @method('put')
        @csrf
        <fieldset class="fieldset_border">
            <legend>Fichier excel</legend>
            <!--div>
                <label>Fichier </label>
                <input type="file" name="url" />
            </div-->
            <div>
                <label>Fichier </label>
                <input type="file" id="filepicker" name="fileList[]" webkitdirectory = "true" multiple />
                <ul id="listing"></ul>
            </div>
            @error('url')
                <div class="alert">{{ $message }}</div>
            @enderror
        </fieldset>
        <input type="submit" class="button button_primary" value="Importer">
    </form>
    <!--script type="text/javascript">
        document.getElementById("filepicker").addEventListener("change", (event) => {
            let output = document.getElementById("listing");
            for (const file of event.target.files) {
                let item = document.createElement("li");
                item.textContent = file.webkitRelativePath;
                output.appendChild(item);
            };
            event.stopPropagation();
        }, false);
    </script-->
@stop
