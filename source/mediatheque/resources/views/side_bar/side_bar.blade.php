    <div
        x-show="isSidebarOpen"
        @click="isSidebarOpen = false"
        class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"
    ></div>
    <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

    <!-- Mobile bottom bar -->
    <nav
        aria-label="Options"
        class="fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-green-100 sm:hidden shadow-t rounded-t-3xl"
    >
        <!-- Menu button -->
        <button
            @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
            class="p-2 transition-colors rounded-lg shadow-md hover:bg-green-800 hover:text-white focus:outline-none focus:ring focus:ring-green-600 focus:ring-offset-white focus:ring-offset-2"
            :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-green-600' : 'text-gray-500 bg-white'"
        >
            <span class="sr-only">Toggle sidebar</span>
            <svg
                aria-hidden="true"
                class="w-6 h-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>

        <!-- Logo -->
        <a href="#">
            <a href="/liste_livres_papier">
                <img src="{{ asset('storage/images/logo.png') }}" class="block h-10 w-auto fill-current text-gray-600">
            </a>
        </a>
    </nav>

    <!-- Left mini bar -->
    <nav
        aria-label="Options"
        class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-green-100 shadow-md sm:flex"
    >
        <!-- Logo -->
        <div class="flex-shrink-0 py-4">
            <a href="#">
                <a href="/liste_livres_papier">
                    <img src="{{ asset('storage/images/logo.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                </a>
            </a>
        </div>
        <div class="flex flex-col items-center flex-1 p-2 space-y-4">
            <!-- Menu button -->
            <button
                @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                class="p-2 transition-colors rounded-lg shadow-md hover:bg-green-800 hover:text-white focus:outline-none focus:ring focus:ring-green-600 focus:ring-offset-white focus:ring-offset-2"
                :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-green-600' : 'text-gray-500 bg-white'"
            >
                <span class="sr-only">Toggle sidebar</span>
                <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>
        </div>
    </nav>

    <div
        x-transition:enter="transform transition-transform duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition-transform duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        x-show="isSidebarOpen"
        class="fixed inset-y-0 left-0 z-10  flex-shrink-0 w-64 bg-white border-r-2 border-green-100 shadow-lg sm:left-16 sm:w-72 lg:static lg:w-64"
    >
        <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center flex-shrink-0 py-10">
                <a href="/liste_livres_papier">
                    <img src="{{ asset('storage/images/logo.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                </a>
            </div>
            <!-- Links -->
            <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
               <ul>
                   <li>
                       <a href="/liste_livres_papier" class="flex items-center w-full space-x-2 text-white bg-green-600 rounded-lg" :active="request()->routeIs('listeLivresPapier')">
                  <span aria-hidden="true" class="p-2 bg-green-700 rounded-lg">
                    <svg
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                      <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                      />
                    </svg>
                  </span>
                           <span>Acceuil</span>
                       </a>
                   </li>
                   <!-- Menu respons -->
                   @if(in_array(Auth::user()->roles()->first()->name, ["responsable", "bibliothecaire"], true))
                       <li>
                           <label class="flex items-center p-2 w-full text-base font-normal text-yellow-600 font-bold" aria-controls="dropdown-example">
                               <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Gestion des ouvrages</span>
                           </label>
                           <ul id="dropdown-example" class="ml-12">
                               <li>
                                   <a href="/liste_livres_papier" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600" >ouvrage physique</a>
                               </li>
                               <li>
                                   <a href="/liste_livres_numerique" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">ouvrage Electronique</a>
                               </li>
                               <li>
                                   <a href="/liste_des_emprunts" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Emprunt</a>
                               </li>
                               <li>
                                   <a href="/liste_des_restitutions" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Réstitution</a>
                               </li>
                           </ul>
                       </li>
                       <li>
                           <label class="flex items-center p-2 w-full text-base font-normal text-yellow-600 font-bold" aria-controls="dropdown-example">
                               <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Gestion des utilisateurs</span>
                           </label>
                           <ul id="dropdown-example" class="ml-12">
                               <li>
                                   <a href="/liste_des_abonnes" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Abonnés</a>
                               </li>
                               @if(Auth::user()->roles()->first()->name == "responsable")
                                   <li>
                                       <a href="/liste_des_personnels" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Presonnels</a>
                                   </li>
                           </ul>
                       </li>
                       <li>
                           <label class="flex items-center p-2 w-full text-base font-normal text-yellow-600 font-bold" aria-controls="dropdown-example">
                               <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Import excel</span>
                           </label>
                           <ul id="dropdown-example" class="ml-12">
                               <li>
                                   <a href="/formulaire_import_excel" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Livres papier</a>
                               </li>
                           </ul>
                       </li>
                      @endif
                   @endif
                   <!-- Menu abonnee -->
                   @if (Auth::user()->roles()->first()->name == "abonne")
                       <li>
                           <ul id="dropdown-example" class="">
                               <li>
                                   <a href="/" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Mon compte</a>
                               </li>
                           </ul>
                           <ul id="dropdown-example" class="">
                               <li>
                                   <a href="/" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Mes emprunts</a>
                               </li>
                           </ul>
                           <ul id="dropdown-example" class="">
                               <li>
                                   <a href="/" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-green-600 hover:bg-green-600">Emprunts en cours</a>
                               </li>
                           </ul>
                       </li>
                   @endif
               </ul>
            </div>
        </nav>
    </div>

