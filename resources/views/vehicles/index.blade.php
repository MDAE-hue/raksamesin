<x-layouts.public title="Raksamesin - Katalog Alat Berat">
    <section class="border-b border-stone-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
            <div class="flex flex-col justify-center">
                <p class="text-sm font-black uppercase tracking-[0.18em] text-amber-600">Marketplace alat berat</p>
                <h1 class="mt-4 max-w-sm text-3xl font-black leading-tight tracking-tight text-stone-950 sm:max-w-3xl sm:text-6xl">Cari unit proyek tanpa drama.</h1>
                <p class="mt-5 max-w-sm text-base leading-8 text-stone-600 sm:max-w-2xl sm:text-lg">Raksamesin membantu pembeli menemukan unit terpercaya dan membantu sales mengelola inquiry, inspeksi, penawaran, sampai deal.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#catalog" class="rounded bg-stone-950 px-5 py-3 text-sm font-black text-white shadow-sm hover:bg-stone-800">Lihat Katalog</a>
                    <a href="{{ route('login') }}" class="rounded border border-stone-300 bg-white px-5 py-3 text-sm font-black text-stone-800 hover:border-amber-500">Masuk Sales</a>
                </div>
                <div class="mt-8 grid gap-3 text-sm sm:grid-cols-3">
                    <div class="rounded border border-stone-200 bg-stone-50 p-4">
                        <p class="text-2xl font-black text-stone-950">{{ $vehicles->total() }}+</p>
                        <p class="text-stone-500">Unit tersedia</p>
                    </div>
                    <div class="rounded border border-stone-200 bg-stone-50 p-4">
                        <p class="text-2xl font-black text-stone-950">CRM</p>
                        <p class="text-stone-500">Lead sampai deal</p>
                    </div>
                    <div class="rounded border border-stone-200 bg-stone-50 p-4">
                        <p class="text-2xl font-black text-stone-950">Verified</p>
                        <p class="text-stone-500">Dokumen & unit</p>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-lg border border-stone-200 bg-stone-100 shadow-sm">
                <img class="h-full min-h-80 w-full bg-stone-900 object-contain" src="/demo/excavator.png" alt="Excavator di area proyek">
            </div>
        </div>
    </section>

    <section id="catalog" class="border-b border-stone-200 bg-stone-100/70">
        <form method="GET" action="{{ route('vehicles.index') }}" class="mx-auto grid max-w-7xl gap-3 px-4 py-5 sm:px-6 md:grid-cols-[1fr_220px_220px_auto] lg:px-8">
            <input name="q" value="{{ request('q') }}" class="rounded border-stone-300 bg-white text-stone-900 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500" placeholder="Cari brand, unit, lokasi">
            <select name="category" class="rounded border-stone-300 bg-white text-stone-900 focus:border-amber-500 focus:ring-amber-500">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <input name="location" value="{{ request('location') }}" class="rounded border-stone-300 bg-white text-stone-900 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500" placeholder="Lokasi">
            <button class="rounded bg-amber-500 px-5 py-2 font-black text-stone-950 shadow-sm hover:bg-amber-400">Cari Unit</button>
        </form>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.16em] text-stone-500">Unit tersedia</p>
                <h2 class="mt-2 text-3xl font-black text-stone-950">Katalog Raksamesin</h2>
            </div>
            <p class="hidden text-sm text-stone-500 sm:block">Pilih unit, kirim inquiry, sales follow up.</p>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse($vehicles as $vehicle)
                <article class="overflow-hidden rounded-lg border border-stone-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                    <a href="{{ route('vehicles.show', $vehicle) }}">
                        <img class="h-56 w-full object-cover" src="{{ $vehicle->imageUrl() }}" alt="{{ $vehicle->name }}">
                    </a>
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3 text-xs">
                            <span class="rounded bg-amber-100 px-2 py-1 font-black text-amber-700">{{ $vehicle->category }}</span>
                            @if($vehicle->is_verified)
                                <span class="rounded bg-emerald-100 px-2 py-1 font-bold text-emerald-700">Verified</span>
                            @endif
                        </div>
                        <h3 class="mt-4 text-xl font-black text-stone-950">
                            <a href="{{ route('vehicles.show', $vehicle) }}">{{ $vehicle->name }}</a>
                        </h3>
                        <p class="mt-2 text-sm text-stone-500">{{ $vehicle->brand }} {{ $vehicle->model }} - {{ $vehicle->year ?? 'Tahun n/a' }} - {{ number_format($vehicle->hour_meter ?? 0) }} HM</p>
                        <p class="mt-3 text-xl font-black text-stone-950">
                            {{ $vehicle->price ? 'Rp '.number_format($vehicle->price, 0, ',', '.') : 'Harga by request' }}
                        </p>
                        <div class="mt-5 flex items-center justify-between gap-3">
                            <span class="text-sm font-semibold text-stone-500">{{ $vehicle->location }}</span>
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="rounded bg-stone-950 px-4 py-2 text-sm font-black text-white hover:bg-amber-500 hover:text-stone-950">Detail</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded border border-stone-200 bg-white p-8 text-center text-stone-500">Belum ada unit yang cocok dengan filter.</div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $vehicles->links() }}
        </div>
    </section>
</x-layouts.public>
