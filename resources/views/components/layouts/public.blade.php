<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Raksamesin' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden bg-slate-50 font-sans text-slate-950 antialiased">
        <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 shadow-sm shadow-slate-900/5 backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('vehicles.index') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 font-black text-amber-400 shadow-sm">R</span>
                    <span>
                        <span class="block text-lg font-black tracking-tight text-slate-950">Raksamesin</span>
                        <span class="block text-xs font-semibold text-slate-500">Heavy equipment marketplace</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-2 text-sm font-bold sm:flex">
                    <a href="{{ route('vehicles.index') }}" class="hidden rounded-full px-4 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 sm:inline">Katalog</a>
                    @auth
                        @if(auth()->user()->canAccessPanel(filament()->getPanel('admin')))
                            <a href="/admin" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded-full bg-slate-950 px-4 py-2 text-white shadow-sm transition hover:bg-slate-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">Login</a>
                        <a href="{{ route('register') }}" class="hidden rounded-full bg-amber-400 px-4 py-2 text-slate-950 shadow-sm transition hover:bg-amber-300 sm:inline-block">Daftar</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto grid max-w-7xl gap-6 px-4 py-10 text-sm text-slate-600 sm:px-6 md:grid-cols-4 lg:px-8">
                <div class="md:col-span-2">
                    <p class="text-lg font-black tracking-tight text-slate-950">Raksamesin</p>
                    <p class="mt-3 max-w-md leading-7">Marketplace alat berat untuk katalog unit, inquiry pembeli, jadwal inspeksi, penawaran, dan follow-up deal.</p>
                </div>
                <div>
                    <p class="font-black text-slate-950">Workflow</p>
                    <p class="mt-3 leading-7">Browse unit, kirim inquiry, sales follow-up, inspeksi, quotation, lalu deal.</p>
                </div>
                <div>
                    <p class="font-black text-slate-950">Sales</p>
                    <p class="mt-3 leading-7">WhatsApp: 0812-0000-0000<br>Email: sales@raksamesin.test</p>
                </div>
            </div>
        </footer>
    </body>
</html>
