@extends('layouts.app')
@section('content')
<main class="flex flex-col justify-center items-center m-auto my_content">
    <div>
        @include('components.search')
    </div>
    @if(!empty($ouvrages ?? "") && $ouvrages->count())
        <div class="flex flex-col items-center mb-12 max-w-4xl" id="books">
        </div>
        <div class="bg-white" id="pagination">
        </div>
    @else
        <h3>Il n'y a aucun ouvrage.</h3>
    @endif
</main>
<div style="z-index:1000" id="overlay" class="fixed z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60 hidden"></div>
<div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
    <div class="flex flex-col items-center space-y-4">
        <div id="id_message" class="">
            <p id="etat_ouvrage_modif_erreur"></p>
        </div>
        <button id="btn_modifier" class="button button_primary">J'ai compris</button>
    </div>
</div>
@endsection
@section('js')
    <!-- Add this line to include twbs-pagination -->
    <script type="text/javaScript">
        const ouvrages = {!! $ouvrages !!};
        console.log(ouvrages);
        let data = [];
        //console.log(ouvrages);
        //load_books(ouvrages);
        function load_books(books) {
            let book_html = "";
            for (let i=0; i <= books.length -1; i++){
                book_html = book_html + show_book(books[i]);
            }
            //console.log(book_html);
            $('#books').html(book_html);
        }

        function show_book(book) {
            return (`
                <div  class="mb-3 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full">
                    <a href="/ouvrages/${book['id_ouvrage']}/">
                        <img
                            class=" hover:bg-gray-100 cursor-pointer object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="${book['image']}" alt=""
                        >
                    </a>
                    <div class="flex flex-col justify-between p-4 leading-normal w-full">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-center">
                            ${book['titre']}
                        </h5>
                        <!--Data réservation-->
                    </div>
                </div>
            `);
        }

        let titre = "";
        let langue = "";
        let type = "";
        let domaine = "";
        let niveau = "";

        function searchOuvrages() {
            // Convertir la requête en minuscules pour une correspondance insensible à la casse
            let result = []
            // Filtrer les ouvrages en fonction de la date
            // Filtrer les ouvrages en fonction du titre
            result = ouvrages.filter((ouvrage) => {
                let min = $('#min').val();
                let max = $('#max').val();

                if (min==""){
                    min = null;
                }

                if (max==""){
                    max = null;
                }

                let date = parseInt(ouvrage.annee_apparution);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            });

            result = result.filter((ouvrage) => ouvrage.titre.toLowerCase().includes(titre.toLowerCase())
                                                     &&  ouvrage.langue.toLowerCase().includes(langue)
                                                     &&  ouvrage.domaine.toLowerCase().includes(domaine)
                                                     &&  ouvrage.id_type.toString().toLowerCase().includes(type)
                                                     &&  ouvrage.id_niveau.toString().toLowerCase().includes(niveau)
                                                     );

            load_books(result);
        }

        // $('#search_by').on('input', ()=>{
        //     // titre = $('#search_by').val();
        //     // searchOuvrages();
        //     submit_form();
        // });

        $('#langue').on('change', ()=>{
            submit_form();
        });

        $('#type').on('change', ()=>{
            submit_form();
        });

        $('#niveau').on('change', ()=>{
            submit_form();
        });

        $('#domaine').on('change', ()=>{
            submit_form();
        });

        $('#min, #max').on('change', () => {
            submit_form();
        });

        function submit_form() {
            $('#form').submit();
        }

        let currentPage = 1;
        const itemsPerPage = 10; // Adjust the number of items per page as needed

        // Function to render books for a specific page
        function renderBooks(page) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const booksToDisplay = ouvrages.slice(startIndex, endIndex);
            load_books(booksToDisplay);
        }

        function initPagination() {
            $('#pagination').twbsPagination({
                totalPages: Math.ceil(ouvrages.length / itemsPerPage),
                visiblePages: 5, // Adjust the number of visible pages as needed
                onPageClick: function (event, page) {
                    currentPage = page;
                    renderBooks(currentPage);
                }
            });
        }

        load_books(ouvrages);
        initPagination();

        function updatePagination() {
            $('#pagination').twbsPagination('destroy');
            initPagination();
        }

    </script>
@endsection
