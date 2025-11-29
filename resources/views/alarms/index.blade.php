@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-[#1A1B23] text-gray-100 px-4">

    {{-- 🌌 Background faded --}}
    <img src="{{ asset('images/senyuminajah.jpg') }}"
         class="absolute bottom-0 left-0 w-40 opacity-[0.07] hidden sm:block pointer-events-none select-none">

    <div class="max-w-6xl mx-auto text-center pt-20 pb-10">

        {{-- 🏆 Hero Title --}}
        <h1 class="text-3xl sm:text-5xl font-bold text-white">
            MARIN
        </h1>

        {{-- 🏆 Hero Title --}}
        <h1 class="text-3xl sm:text-5xl font-bold text-white mt-2">
            Maintenance and Alarm Reference Information Network
        </h1>

        {{-- 🔎 Deskripsi --}}
        <p class="text-gray-300 text-base sm:text-lg max-w-3xl mx-auto mt-6 leading-relaxed">
            Sistem ini menyediakan informasi detail, langkah perbaikan, 
            sensor terkait dan dokumentasi komponen untuk setiap kode alarm. Semua yang kamu butuhkan ada di sini.
        </p>

        {{-- 🔥 Alarm Menu --}}
        <div class="mt-14">
            <h2 class="text-2xl font-semibold flex items-center justify-center gap-2 text-red-400">
                <span>🔥</span> Alarm Categories
            </h2>

            <div id="alarm-menus" class="flex flex-col sm:flex-row flex-wrap justify-center gap-4 mt-6">
                {{-- Links akan di-generate via JS --}}
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const host = window.location.hostname; // ambil IP/hostname yang dipakai untuk akses
    const menus = [
        { name: 'Depalletiser', port: 8001, emoji: '🏭' },
        { name: 'Bulkglass', port: 8002, emoji: '🧪' },
        { name: 'Robocolumn', port: 8003, emoji: '🤖' },
    ];

    const container = document.getElementById('alarm-menus');

    menus.forEach(menu => {
        const a = document.createElement('a');
        a.href = `http://${host}:${menu.port}`;
        a.className = 'bg-[#2A2C36] hover:bg-[#343643] border border-[#3A3C47] shadow-md px-6 py-3 rounded-xl transition text-white font-medium flex items-center justify-center gap-2';
        a.innerHTML = `${menu.emoji} ${menu.name}`;
        container.appendChild(a);
    });
});

window.addEventListener('load', function() {
    if (typeof Shepherd === 'undefined') return;

    const TOUR_KEY = 'alarm_index_tour_pydwen';

    window.tour = new Shepherd.Tour({
        defaultStepOptions: {
            cancelIcon: { enabled: true },
            classes: 'shadow-lg bg-[#1F2028] text-white rounded-lg border border-[#343541]',
            scrollTo: { behavior: 'smooth', block: 'center' }
        },
        useModalOverlay: true
    });

    const addStepIf = (selector, opts) => {
        const el = document.querySelector(selector);
        if (el) {
            opts.attachTo.element = el;
            window.tour.addStep(opts);
        }
    };

    // 👋 Welcome
    addStepIf('h1', {
        title: 'Selamat Datang 👋',
        text: 'Halaman ini menampilkan penjelasan umum dan daftar pencarian alarm terpopuler.',
        attachTo: { on: 'bottom' },
        buttons: [{ text: 'Lanjut', action: window.tour.next }]
    });

    // 🔥 Popular Search
    addStepIf('.popular-search', {
        title: 'Pencarian Terpopuler 🔥',
        text: 'Klik salah satu untuk langsung melihat panduan lengkap alarm tersebut.',
        attachTo: { on: 'top' },
        buttons: [{ text: 'Selesai', action: window.tour.complete }]
    });

    // 🚀 Auto run once
    if (!localStorage.getItem(TOUR_KEY)) {
        setTimeout(() => {
            window.tour.start();
            localStorage.setItem(TOUR_KEY, 1);
        }, 500);
    }
});

// 📌 Global Manual Trigger
function startTutorial() {
    if (window.tour) window.tour.start();
}
</script>
@endsection
