<nav class="bg-[#1A1B23] border-b border-[#1C1D23] text-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- 🔵 Logo + Title -->
            <div class="flex items-center">
                <a href="{{ route('alarms.index') }}" 
                   class="text-lg font-bold text-white hover:text-blue-400 transition">
                    MARIN
                </a>

                <!-- 🟢 Desktop Navigation -->
                <button onclick="startTutorial()"
                    class="hidden sm:block ms-10 text-gray-300 hover:text-blue-400 font-medium text-sm transition">
                    
                </button>
            </div>

                    <!-- 👤 Desktop User -->
<div class="hidden sm:flex sm:items-center sm:ml-6 relative">

{{-- 🔴 Visitor Counter (pindah ke sini) --}}
@can('isAdmin')
    @isset($visitorCount)
        <div class="flex items-center text-sm text-gray-200 bg-red-600 px-3 py-1 rounded-lg shadow-sm mr-3 border border-red-800">
            👁️ <span class="ml-1 font-semibold">{{ $visitorCount }}</span>
        </div>
    @endisset
@endcan

{{-- 🔵 Tombol Tutorial --}}
<button onclick="startTutorial()"
    class="mr-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
    Tutorial
</button>

<!-- {{-- 🟥 Guest / Username --}}
<button id="desktop-dropdown-btn"
    class="inline-flex items-center px-3 py-2 text-sm font-semibold rounded-md bg-red-600 text-white hover:bg-red-700 transition">
    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
    <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M6 8l4 4 4-4" />
    </svg>
</button> -->

<div id="desktop-dropdown-menu" 
    class="absolute right-0 mt-2 w-48 bg-[#1F2028] border border-[#2C2D35] rounded-md shadow-xl hidden z-50">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="block w-full text-left px-4 py-2 text-red-400 hover:bg-[#2A2B33]">
            Log Out
        </button>
    </form>
</div>
</div>




            <!-- 📱 Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button id="hamburger-btn"
                    class="p-2 rounded-md text-gray-300 hover:bg-[#1F2028] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="hamburger-icon" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path id="close-icon" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- 📱 Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-[#1A1B23] border-t border-[#1C1D23]">
        <div class="pt-2 pb-3">
        <button onclick="startTutorial()" 
    class="block w-full px-4 py-2 text-white font-medium text-sm bg-[#3B82F6] hover:bg-[#2563EB] mt-2">
    Show Tutorial
</button>

        </div>

        <!-- 👤 Mobile User -->
        <div class="border-t border-[#2A2B33] bg-[#15161D]">
            <div class="px-4 py-3">
            <button id="mobile-dropdown-btn" 
    class="font-medium text-base text-white w-full text-left bg-[#EF4444] hover:bg-[#DC2626] px-3 py-2 rounded-md">
    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
</button>

            </div>

            <div id="mobile-dropdown-menu" class="hidden border-t border-[#2A2B33]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-red-400 font-semibold hover:bg-[#2A2B33]">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- ⚙️ JS Toggle Menu -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
    const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

    const desktopDropdownBtn = document.getElementById('desktop-dropdown-btn');
    const desktopDropdownMenu = document.getElementById('desktop-dropdown-menu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });

    mobileDropdownBtn.addEventListener('click', () => {
        mobileDropdownMenu.classList.toggle('hidden');
    });

    desktopDropdownBtn.addEventListener('click', () => {
        desktopDropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(e) {
        if (!desktopDropdownBtn.contains(e.target) && !desktopDropdownMenu.contains(e.target)) {
            desktopDropdownMenu.classList.add('hidden');
        }
    });
});
</script>
