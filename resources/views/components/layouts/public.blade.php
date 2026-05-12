<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Raksamesin' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden bg-stone-50 font-sans text-stone-950 antialiased">
        <header class="sticky top-0 z-50 border-b border-stone-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('vehicles.index') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded bg-amber-500 font-black text-stone-950 shadow-sm">R</span>
                    <span>
                        <span class="block text-lg font-black tracking-wide">Raksamesin</span>
                        <span class="block text-xs font-medium text-stone-500">Marketplace alat berat terpercaya</span>
                    </span>
                </a>
                <nav class="flex items-center gap-2 text-sm font-semibold">
                    <a href="{{ route('vehicles.index') }}" class="hidden rounded px-3 py-2 text-stone-600 hover:bg-stone-100 hover:text-stone-950 sm:inline">Katalog</a>
                    @auth
                        @if(auth()->user()->canAccessPanel(filament()->getPanel('admin')))
                            <a href="/admin" class="rounded border border-stone-300 px-3 py-2 text-stone-700 hover:border-amber-500 hover:text-stone-950">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded bg-stone-950 px-3 py-2 text-white hover:bg-stone-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded border border-stone-300 px-3 py-2 text-stone-700 hover:border-amber-500 hover:text-stone-950">Login</a>
                        <a href="{{ route('register') }}" class="hidden rounded bg-amber-500 px-3 py-2 text-stone-950 shadow-sm hover:bg-amber-400 sm:inline-block">Daftar</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="border-t border-stone-200 bg-white">
            <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 text-sm text-stone-600 sm:px-6 md:grid-cols-3 lg:px-8">
                <div>
                    <p class="font-black text-stone-950">Raksamesin</p>
                    <p class="mt-2">Broker digital untuk unit alat berat, inspeksi, penawaran, dan deal proyek.</p>
                </div>
                <div>
                    <p class="font-bold text-stone-950">Workflow</p>
                    <p class="mt-2">Katalog, inquiry, follow-up sales, inspeksi, quotation, lalu deal.</p>
                </div>
                <div>
                    <p class="font-bold text-stone-950">Kontak</p>
                    <p class="mt-2">WhatsApp Sales: 0812-0000-0000</p>
                </div>
            </div>
        </footer>
    </body>
</html>
