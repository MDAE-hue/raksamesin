<x-layouts.public title="Raksamesin - Katalog Alat Berat">
    <section class="bg-zinc-900">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
            <div class="flex flex-col justify-center">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-400">Marketplace alat berat</p>
                <h1 class="mt-4 max-w-3xl text-4xl font-black leading-tight text-white sm:text-5xl">Raksamesin</h1>
                <p class="mt-4 max-w-2xl text-lg text-zinc-300">Temukan excavator, bulldozer, wheel loader, crane, forklift, dan armada proyek dengan lead sales yang siap bantu sampai deal.</p>
                <div class="mt-8 grid grid-cols-3 gap-3 text-sm">
                    <div class="border border-white/10 bg-zinc-950 p-4">
                        <p class="text-2xl font-black text-white">{{ $vehicles->total() }}+</p>
                        <p class="text-zinc-400">Unit tersedia</p>
                    </div>
                    <div class="border border-white/10 bg-zinc-950 p-4">
                        <p class="text-2xl font-black text-white">CRM</p>
                        <p class="text-zinc-400">Lead sampai deal</p>
                    </div>
                    <div class="border border-white/10 bg-zinc-950 p-4">
                        <p class="text-2xl font-black text-white">Verified</p>
                        <p class="text-zinc-400">Dokumen & unit</p>
                    </div>
                </div>
            </div>
            <div class="min-h-72 overflow-hidden rounded border border-white/10 bg-zinc-950">
                <img class="h-full min-h-72 w-full object-cover" src="/demo/excavator.png" alt="Excavator di area proyek">
            </div>
        </div>
    </section>

    <section class="border-y border-white/10 bg-zinc-950">
        <form method="GET" action="{{ route('vehicles.index') }}" class="mx-auto grid max-w-7xl gap-3 px-4 py-5 sm:px-6 md:grid-cols-[1fr_220px_220px_auto] lg:px-8">
            <input name="q" value="{{ request('q') }}" class="border-zinc-700 bg-zinc-900 text-zinc-100 placeholder:text-zinc-500 focus:border-amber-500 focus:ring-amber-500" placeholder="Cari brand, unit, lokasi">
            <select name="category" class="border-zinc-700 bg-zinc-900 text-zinc-100 focus:border-amber-500 focus:ring-amber-500">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <input name="location" value="{{ request('location') }}" class="border-zinc-700 bg-zinc-900 text-zinc-100 placeholder:text-zinc-500 focus:border-amber-500 focus:ring-amber-500" placeholder="Lokasi">
            <button class="bg-amber-500 px-5 py-2 font-bold text-zinc-950 hover:bg-amber-400">Cari Unit</button>
        </form>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse($vehicles as $vehicle)
                <article class="overflow-hidden border border-white/10 bg-zinc-900">
                    <a href="{{ route('vehicles.show', $vehicle) }}">
                        <img class="h-56 w-full object-cover" src="{{ $vehicle->imageUrl() }}" alt="{{ $vehicle->name }}">
                    </a>
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3 text-xs">
                            <span class="bg-zinc-800 px-2 py-1 font-semibold text-amber-300">{{ $vehicle->category }}</span>
                            @if($vehicle->is_verified)
                                <span class="text-emerald-400">Verified</span>
                            @endif
                        </div>
                        <h2 class="mt-4 text-xl font-bold text-white">
                            <a href="{{ route('vehicles.show', $vehicle) }}">{{ $vehicle->name }}</a>
                        </h2>
                        <p class="mt-2 text-sm text-zinc-400">{{ $vehicle->brand }} {{ $vehicle->model }} • {{ $vehicle->year ?? 'Tahun n/a' }} • {{ number_format($vehicle->hour_meter ?? 0) }} HM</p>
                        <p class="mt-3 text-lg font-black text-amber-400">
                            {{ $vehicle->price ? 'Rp '.number_format($vehicle->price, 0, ',', '.') : 'Harga by request' }}
                        </p>
                        <div class="mt-5 flex items-center justify-between gap-3">
                            <span class="text-sm text-zinc-400">{{ $vehicle->location }}</span>
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="bg-white px-3 py-2 text-sm font-bold text-zinc-950 hover:bg-amber-400">Detail</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full border border-white/10 bg-zinc-900 p-8 text-center text-zinc-300">Belum ada unit yang cocok dengan filter.</div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $vehicles->links() }}
        </div>
    </section>
</x-layouts.public>
