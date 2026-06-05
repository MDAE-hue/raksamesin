<x-layouts.public title="{{ $vehicle->name }} - Raksamesin">
    <section class="bg-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_420px] lg:px-8 lg:py-10">
            <div>
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-black text-slate-600 shadow-sm transition hover:border-slate-300 hover:text-slate-950">Kembali ke katalog</a>

                <div class="mt-5 overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-100 shadow-xl shadow-slate-950/10">
                    <img class="h-[470px] w-full object-cover" src="{{ $vehicle->imageUrl() }}" alt="{{ $vehicle->name }}">
                </div>

                @if(count($vehicle->images ?? []) > 1)
                    <div class="mt-4 grid grid-cols-3 gap-3">
                        @foreach(array_slice($vehicle->images ?? [], 1, 3) as $index => $image)
                            <img class="h-28 w-full rounded-2xl border border-slate-200 object-cover shadow-sm" src="{{ $vehicle->imageUrl($index + 1) }}" alt="{{ $vehicle->name }}">
                        @endforeach
                    </div>
                @endif

                <div class="mt-8">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-black uppercase tracking-[0.12em] text-amber-700">{{ $vehicle->category }}</span>
                        @if($vehicle->is_verified)
                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-black text-emerald-700">Verified unit</span>
                        @endif
                    </div>
                    <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">{{ $vehicle->name }}</h1>
                    <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-600">{{ $vehicle->description }}</p>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    @foreach(($vehicle->specifications ?? []) as $label => $value)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-black uppercase tracking-wide text-slate-400">{{ $label }}</p>
                            <p class="mt-1 font-black text-slate-950">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="h-fit rounded-[2rem] border border-slate-200 bg-white p-5 shadow-xl shadow-slate-950/10 lg:sticky lg:top-28">
                @if(session('status'))
                    <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-800">{{ session('status') }}</div>
                @endif

                <div class="border-b border-slate-200 pb-5">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-sm font-bold text-slate-500">{{ $vehicle->brand }} {{ $vehicle->model }} - {{ $vehicle->location }}</p>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-black text-slate-600">{{ $vehicle->condition }}</span>
                    </div>
                    <p class="mt-3 text-3xl font-black tracking-tight text-slate-950">{{ $vehicle->price ? 'Rp '.number_format($vehicle->price, 0, ',', '.') : 'Harga by request' }}</p>
                    <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="font-bold text-slate-500">Tahun</p>
                            <p class="mt-1 text-lg font-black text-slate-950">{{ $vehicle->year ?? '-' }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="font-bold text-slate-500">Hour meter</p>
                            <p class="mt-1 text-lg font-black text-slate-950">{{ number_format($vehicle->hour_meter ?? 0) }} HM</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('vehicles.inquiry', $vehicle) }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-black text-slate-700">Nama</label>
                        <input name="name" value="{{ old('name', auth()->user()->name ?? '') }}" class="mt-1 w-full rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm focus:border-amber-400 focus:ring-amber-400" required>
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm font-black text-slate-700">Perusahaan</label>
                        <input name="company" value="{{ old('company', auth()->user()->company ?? '') }}" class="mt-1 w-full rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm focus:border-amber-400 focus:ring-amber-400">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-black text-slate-700">Email</label>
                            <input name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="mt-1 w-full rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm focus:border-amber-400 focus:ring-amber-400">
                        </div>
                        <div>
                            <label class="text-sm font-black text-slate-700">WhatsApp</label>
                            <input name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="mt-1 w-full rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm focus:border-amber-400 focus:ring-amber-400" required>
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <input name="budget" value="{{ old('budget') }}" class="rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm placeholder:text-slate-400 focus:border-amber-400 focus:ring-amber-400" placeholder="Budget">
                        <input name="project_location" value="{{ old('project_location') }}" class="rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm placeholder:text-slate-400 focus:border-amber-400 focus:ring-amber-400" placeholder="Lokasi proyek">
                    </div>
                    <textarea name="message" rows="4" class="w-full rounded-2xl border-slate-200 bg-white text-slate-950 shadow-sm placeholder:text-slate-400 focus:border-amber-400 focus:ring-amber-400" placeholder="Kebutuhan, jadwal inspeksi, atau catatan negosiasi">{{ old('message') }}</textarea>
                    <button class="w-full rounded-2xl bg-amber-400 px-5 py-3 font-black text-slate-950 shadow-sm transition hover:bg-amber-300">Minta Penawaran</button>
                </form>
            </aside>
        </div>
    </section>

    @if($relatedVehicles->isNotEmpty())
        <section class="border-t border-slate-200 bg-slate-50">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <p class="text-sm font-black uppercase tracking-[0.16em] text-slate-500">Related equipment</p>
                        <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-950">Unit terkait</h2>
                    </div>
                    <a href="{{ route('vehicles.index') }}" class="hidden rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-black text-slate-700 shadow-sm transition hover:border-slate-300 sm:inline-flex">Lihat semua</a>
                </div>
                <div class="mt-6 grid gap-5 md:grid-cols-3">
                    @foreach($relatedVehicles as $relatedVehicle)
                        <a href="{{ route('vehicles.show', $relatedVehicle) }}" class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-950/10">
                            <img class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $relatedVehicle->imageUrl() }}" alt="{{ $relatedVehicle->name }}">
                            <div class="p-4">
                                <p class="font-black text-slate-950">{{ $relatedVehicle->name }}</p>
                                <p class="mt-1 text-sm font-semibold text-slate-500">{{ $relatedVehicle->location }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.public>
