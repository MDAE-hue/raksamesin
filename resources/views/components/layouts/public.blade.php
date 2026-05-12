<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Raksamesin' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-zinc-950 font-sans text-zinc-100 antialiased">
        <header class="border-b border-white/10 bg-zinc-950/90">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('vehicles.index') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded bg-amber-500 font-black text-zinc-950">R</span>
                    <span>
                        <span class="block text-lg font-bold tracking-wide">Raksamesin</span>
                        <span class="block text-xs text-zinc-400">Jual beli alat berat terpercaya</span>
                    </span>
                </a>
                <nav class="flex items-center gap-3 text-sm">
                    <a href="{{ route('vehicles.index') }}" class="hidden text-zinc-300 hover:text-white sm:inline">Katalog</a>
                    @auth
                        @if(auth()->user()->canAccessPanel(filament()->getPanel('admin')))
                            <a href="/admin" class="rounded border border-white/15 px-3 py-2 text-zinc-200 hover:border-amber-400 hover:text-amber-300">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded bg-white px-3 py-2 font-semibold text-zinc-950">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded border border-white/15 px-3 py-2 text-zinc-200 hover:border-amber-400 hover:text-amber-300">Login</a>
                        <a href="{{ route('register') }}" class="rounded bg-amber-500 px-3 py-2 font-semibold text-zinc-950 hover:bg-amber-400">Daftar</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="border-t border-white/10 bg-zinc-950">
            <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 text-sm text-zinc-400 sm:px-6 md:grid-cols-3 lg:px-8">
                <div>
                    <p class="font-semibold text-zinc-100">Raksamesin</p>
                    <p class="mt-2">Marketplace dan broker digital untuk unit alat berat, inspeksi, penawaran, dan deal proyek.</p>
                </div>
                <div>
                    <p class="font-semibold text-zinc-100">Workflow</p>
                    <p class="mt-2">Katalog, inquiry, follow-up sales, inspeksi, quotation, lalu deal.</p>
                </div>
                <div>
                    <p class="font-semibold text-zinc-100">Kontak</p>
                    <p class="mt-2">WhatsApp Sales: 0812-0000-0000</p>
                </div>
            </div>
        </footer>
    </body>
</html>
