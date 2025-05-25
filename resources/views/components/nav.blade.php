<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold font-merriweather text-primary flex items-center">BATANGAS <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1e40af"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-7-.5-14.5T799-507q-5 29-27 48t-52 19h-80q-33 0-56.5-23.5T560-520v-40H400v-80q0-33 23.5-56.5T480-720h40q0-23 12.5-40.5T563-789q-20-5-40.5-8t-42.5-3q-134 0-227 93t-93 227h200q66 0 113 47t47 113v40H400v110q20 5 39.5 7.5T480-160Z"/></svg>BULLETIN</a>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    @foreach(\App\Models\Category::all() as $category)
                        <a href="{{ url('/category', [$category->slug]) }}"
                           class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <form action="/search" method="POST">
                        @csrf
                        <input type="search" placeholder="Search news..."
                               name="search"
                               id="search"
                               value="{{ old('search') }}"
                               class="bg-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <button type="submit" class="absolute right-2 top-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>

                </div>
                @guest()
                    <a href="/login" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium">Login</a>
                    <a href="/register"
                       class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Register</a>
                @endguest
                @auth()
                    <form action="/logout" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="cursor-pointer"><img class="w-10 h-10 rounded-full"
                                                                          src="http://picsum.photos/100"
                                                                          alt="Rounded avatar"></button>
                    </form>
                @endauth
            </div>

            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-primary focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @foreach(\App\Models\Category::all() as $category)
                <a href="{{ url('/category', [$category->slug]) }}"
                   class="text-gray-600 hover:text-primary block px-3 py-2 text-base font-medium">
                    {{ $category->name }}
                </a>
            @endforeach
            <div class="border-t pt-4">
                <div class="px-3 pb-3">
                    <input type="text" placeholder="Search news..."
                           class="w-full bg-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                @guest()
                    <a href="/login" class="text-gray-600 block px-3 py-2 text-base font-medium">Login</a>
                    <a href="/register" class="text-primary block px-3 py-2 text-base font-medium">Register</a>ndguest
                @endguest
                @auth()
                    <form action="/logout" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="cursor-pointer text-secondary text-xs font-semibold">Log Out</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
