    <div
        x-show="isSidebarOpen"
        @click="isSidebarOpen = false"
        class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"
    ></div>
    <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

    <!-- Mobile bottom bar -->
    <nav
        aria-label="Options"
        class="fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-indigo-100 sm:hidden shadow-t rounded-t-3xl"
    >
        <!-- Menu button -->
        <button
            @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
            class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
            :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
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
            <img
                class="w-10 h-auto"
                src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png"
                alt="K-UI"
            />
        </a>

        <!-- User avatar button -->
        <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
            <button
                @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
            >
                <img
                    class="w-8 h-8 rounded-lg shadow-md"
                    src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                    alt="Ahmed Kamel"
                />
                <span class="sr-only">User menu</span>
            </button>
            <div
                x-show="isOpen"
                @click.away="isOpen = false"
                @keydown.escape="isOpen = false"
                x-ref="userMenu"
                tabindex="-1"
                class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-label="user menu"
            >
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                >Your Profile</a
                >

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
            </div>
        </div>
    </nav>

    <!-- Left mini bar -->
    <nav
        aria-label="Options"
        class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-indigo-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl"
    >
        <!-- Logo -->
        <div class="flex-shrink-0 py-4">
            <a href="#">
                <img
                    class="w-10 h-auto"
                    src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png"
                    alt="K-UI"
                />
            </a>
        </div>
        <div class="flex flex-col items-center flex-1 p-2 space-y-4">
            <!-- Menu button -->
            <button
                @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
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
            <!-- Notifications button -->
            <!--button
                @click="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'"
                class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                :class="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
            >
                <span class="sr-only">Toggle notifications panel</span>
                <svg
                    aria-hidden="true"
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
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                    />
                </svg>
            </button-->
        </div>

        <!-- User avatar -->
        <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
            <button
                @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
            >
                <img
                    class="w-10 h-10 rounded-lg shadow-md"
                    src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                    alt="Ahmed Kamel"
                />
                <span class="sr-only">User menu</span>
            </button>
            <div
                x-show="isOpen"
                @click.away="isOpen = false"
                @keydown.escape="isOpen = false"
                x-ref="userMenu"
                tabindex="-1"
                class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-label="user menu"
            >
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                >Your Profile</a
                >

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
            </div>
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
        class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-64 bg-white border-r-2 border-indigo-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64"
    >
        <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center flex-shrink-0 py-10">
                <a href="#">
                    <img
                        class="w-24 h-auto"
                        src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png"
                        alt="K-UI"
                    />
                </a>
            </div>
            <!-- Links -->
            <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
               <ul>
                   <li>
                       <a href="" class="flex items-center w-full space-x-2 text-white bg-indigo-600 rounded-lg">
                  <span aria-hidden="true" class="p-2 bg-indigo-700 rounded-lg">
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
                           <span>Home</span>
                       </a>
                   </li>
                   <li>
                       <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                           <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Gestion des ouvrages</span>
                       </button>
                       <ul id="dropdown-example" class="ml-12">
                           <li>
                               <a href="/liste_livres_papier" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600">ouvrage physique</a>
                           </li>
                           <li>
                               <a href="/liste_livres_numerique" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600">ouvrage Electronique</a>
                           </li>
                           <li>
                               <a href="/liste_emprunts" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600">Emprunt</a>
                           </li>
                           <li>
                               <a href="/liste_restitutions" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600">Réstitution</a>
                           </li>
                       </ul>
                   </li>
                   <li>
                       <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                           <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Gestion des utilisateurs</span>
                       </button>
                       <ul id="dropdown-example" class="ml-12">
                           <li>
                               <a href="#" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600">Abonnés</a>
                           </li>
                           <li>
                               <a href="#" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group hover:text-white text-indigo-600 hover:bg-indigo-600">Presonnels</a>
                           </li>
                       </ul>
                   </li>
               </ul>
            </div>
        </nav>
        <section x-show="currentSidebarTab == 'notificationsTab'" class="px-4 py-6">
            <h2 class="text-xl">Notifications</h2>
        </section>
    </div>

