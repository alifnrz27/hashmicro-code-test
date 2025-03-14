<nav class="bg-white shadow-md p-4 fixed w-screen" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('login') }}" class="text-2xl font-bold text-blue-600">alifnrz</a>

        <!-- Menu Items (Desktop) -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ route('character.match') }}" class="px-4 py-2 rounded-md {{ request()->routeIs('character.match') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                Char Count
            </a>
            <a href="{{ route('scores.index') }}" class="px-4 py-2 rounded-md {{ request()->routeIs('scores.index') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-blue-500' }}">
                Score
            </a>
        </div>

        <!-- Auth Buttons (Desktop) -->
        <div class="hidden md:flex space-x-4">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-md {{ request()->routeIs('login') ? 'bg-blue-500 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                    Login
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open" class="text-gray-600 focus:outline-none">
                <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden bg-white shadow-md mt-2 rounded-md"
        x-show="open" 
        x-transition.origin.top.left
        class="absolute w-full left-0">
        <a href="{{ route('character.match') }}" class="block py-2 px-4 rounded-md {{ request()->routeIs('character.match') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-200' }}">
            Char Count
        </a>
        <a href="{{ route('scores.index') }}" class="block py-2 px-4 rounded-md {{ request()->routeIs('scores.index') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-200' }}">
            Score
        </a>

        @auth
            <form action="{{ route('logout') }}" method="POST" class="block py-2 px-4">
                @csrf
                <button type="submit" class="w-full text-left text-gray-600 hover:bg-gray-200">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block py-2 px-4 rounded-md {{ request()->routeIs('login') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-200' }}">
                Login
            </a>
        @endauth
    </div>
</nav>
