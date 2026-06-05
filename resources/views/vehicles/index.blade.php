<x-layouts.public title="Raksamesin - Katalog Alat Berat">
    <section class="relative overflow-hidden bg-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(251,191,36,0.20),_transparent_32%),linear-gradient(120deg,_#ffffff_0%,_#f8fafc_52%,_#e2e8f0_100%)]"></div>
        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8 lg:py-16">
            <div class="min-w-0">
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-black uppercase tracking-[0.18em] text-slate-600 shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                    Marketplace alat berat
                </div>
                <h1 class="mt-6 max-w-sm break-words text-3xl font-black leading-[1.08] tracking-tight text-slate-950 sm:max-w-3xl sm:text-6xl">
                    Temukan unit berat siap kerja untuk proyek berikutnya.
                </h1>
                <p class="mt-5 max-w-sm break-words text-base leading-8 text-slate-600 sm:max-w-2xl sm:text-lg">
                    Browse excavator, bulldozer, loader, dan unit proyek lain. Kirim inquiry, atur inspeksi, lalu lanjutkan penawaran dengan workflow sales yang rapi.
                </p>

                <div class="mt-8 flex max-w-sm flex-wrap gap-3 sm:max-w-none">
                    <a href="#catalog" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-black text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">Browse Equipment</a>
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-black text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300">Masuk Sales</a>
                </div>

                <div class="mt-9 grid max-w-sm gap-3 sm:max-w-2xl sm:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-3xl font-black text-slate-950">{{ $vehicles->total() }}+</p>
                        <p class="mt-1 text-sm font-semibold text-slate-500">Unit tersedia</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-3xl font-black text-slate-950">CRM</p>
                        <p class="mt-1 text-sm font-semibold text-slate-500">Inquiry to deal</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-3xl font-black text-slate-950">Verified</p>
                        <p class="mt-1 text-sm font-semibold text-slate-500">Unit & dokumen</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute left-4 top-10 z-10 hidden rounded-2xl border border-white bg-white p-4 shadow-2xl shadow-slate-950/20 lg:block">
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-slate-500">Lead pipeline</p>
                    <p class="mt-2 text-2xl font-black text-slate-950">18 inquiry aktif</p>
                </div>
                <div class="overflow-hidden rounded-[2rem] border border-white bg-slate-950 shadow-2xl shadow-slate-950/20">
                    <img class="h-[430px] w-full object-cover opacity-90" src="/demo/hero-equipment.jpg" alt="Excavator di area proyek">
                </div>
                <div class="absolute bottom-5 right-5 rounded-2xl border border-white/70 bg-white/95 p-4 shadow-xl shadow-slate-950/10 backdrop-blur">
                    <p class="text-sm font-black text-slate-950">Unit siap inspeksi</p>
                    <p class="mt-1 text-xs font-semibold text-slate-500">Excavator, bulldozer, wheel loader</p>
                </div>
            </div>
        </div>
    </section>

    <section id="catalog" class="border-y border-slate-200 bg-slate-50">
        <form method="GET" action="{{ route('vehicles.index') }}" class="mx-auto grid max-w-7xl gap-3 px-4 py-5 sm:px-6 md:grid-cols-[1fr_220px_220px_auto] lg:px-8">
            <input name="q" value="{{ request('q') }}" class="rounded-2xl border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-amber-400 focus:ring-amber-400" placeholder="Cari brand, unit, lokasi">
            <select name="category" class="rounded-2xl border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-amber-400 focus:ring-amber-400">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <input name="location" value="{{ request('location') }}" class="rounded-2xl border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-amber-400 focus:ring-amber-400" placeholder="Lokasi">
            <button class="rounded-2xl bg-amber-400 px-6 py-3 font-black text-slate-950 shadow-sm transition hover:bg-amber-300">Cari Unit</button>
        </form>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-7 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.16em] text-slate-500">Available equipment</p>
                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-950">Katalog Raksamesin</h2>
            </div>
            <p class="max-w-md text-sm font-semibold leading-6 text-slate-500">Pilih unit, cek spesifikasi utama, lalu kirim inquiry untuk jadwal inspeksi dan penawaran.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($vehicles as $vehicle)
                <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-slate-950/10">
                    <a href="{{ route('vehicles.show', $vehicle) }}" class="relative block overflow-hidden bg-slate-100">
                        <img class="h-60 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $vehicle->imageUrl() }}" alt="{{ $vehicle->name }}">
                        <div class="absolute left-4 top-4 flex gap-2">
                            <span class="rounded-full bg-white/95 px-3 py-1 text-xs font-black text-slate-800 shadow-sm">{{ $vehicle->category }}</span>
                            @if($vehicle->is_verified)
                                <span class="rounded-full bg-emerald-100/95 px-3 py-1 text-xs font-black text-emerald-700 shadow-sm">Verified</span>
                            @endif
                        </div>
                    </a>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-black tracking-tight text-slate-950">
                                    <a href="{{ route('vehicles.show', $vehicle) }}">{{ $vehicle->name }}</a>
                                </h3>
                                <p class="mt-2 text-sm font-semibold text-slate-500">{{ $vehicle->brand }} {{ $vehicle->model }} - {{ $vehicle->year ?? 'Tahun n/a' }}</p>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-black text-slate-600">{{ number_format($vehicle->hour_meter ?? 0) }} HM</span>
                        </div>

                        <div class="mt-5 flex items-end justify-between gap-4 border-t border-slate-100 pt-5">
                            <div>
                                <p class="text-xs font-black uppercase tracking-[0.12em] text-slate-400">Harga</p>
                                <p class="mt-1 text-xl font-black text-slate-950">{{ $vehicle->price ? 'Rp '.number_format($vehicle->price, 0, ',', '.') : 'By request' }}</p>
                                <p class="mt-2 text-sm font-semibold text-slate-500">{{ $vehicle->location }}</p>
                            </div>
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="rounded-full bg-slate-950 px-5 py-2.5 text-sm font-black text-white shadow-sm transition hover:bg-amber-400 hover:text-slate-950">Detail</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-slate-200 bg-white p-10 text-center font-semibold text-slate-500 shadow-sm">Belum ada unit yang cocok dengan filter.</div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $vehicles->links() }}
        </div>
    </section>
</x-layouts.public>
