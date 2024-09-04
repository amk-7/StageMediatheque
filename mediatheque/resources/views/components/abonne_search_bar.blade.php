<form class="flex flex-col items-center" method="get" action="">
    <div class="w-96 lg:w-[800px]">
        <div class="flex flex-row w-full border border-green-500">
            <input class="w-10/12 lg:w-11/12 border border-none py-3" type="text" name="search" id="search" placeholder="rechercher par libelle" value="{{ old('selected_search_by') }}">
            <button type="submit" class="flex flex-col items-center justify-center w-2/12 lg:w-1/12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </div>
    </div>
</form>
