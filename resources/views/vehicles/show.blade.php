<x-layouts.public title="{{ $vehicle->name }} - Raksamesin">
    <section class="border-b border-stone-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_420px] lg:px-8">
            <div>
                <a href="{{ route('vehicles.index') }}" class="text-sm font-bold text-stone-500 hover:text-amber-700">Kembali ke katalog</a>
                <div class="mt-4 overflow-hidden rounded-lg border border-stone-200 bg-stone-100 shadow-sm">
                    <img class="h-[460px] w-full object-cover" src="{{ $vehicle->imageUrl() }}" alt="{{ $vehicle->name }}">
                </div>
                <div class="mt-4 grid grid-cols-3 gap-3">
                    @foreach(array_slice($vehicle->images ?? [], 1, 3) as $index => $image)
                        <img class="h-28 w-full rounded border border-stone-200 object-cover" src="{{ $vehicle->imageUrl($index + 1) }}" alt="{{ $vehicle->name }}">
                    @endforeach
                </div>

                <div class="mt-8">
                    <p class="text-sm font-black uppercase tracking-[0.18em] text-amber-600">{{ $vehicle->category }}</p>
                    <h1 class="mt-3 text-4xl font-black tracking-tight text-stone-950">{{ $vehicle->name }}</h1>
                    <p class="mt-4 max-w-3xl text-lg leading-8 text-stone-600">{{ $vehicle->description }}</p>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    @foreach(($vehicle->specifications ?? []) as $label => $value)
                        <div class="rounded border border-stone-200 bg-stone-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-stone-400">{{ $label }}</p>
                            <p class="mt-1 font-black text-stone-950">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="h-fit rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
                @if(session('status'))
                    <div class="mb-5 rounded border border-emerald-200 bg-emerald-50 p-3 text-sm font-semibold text-emerald-800">{{ session('status') }}</div>
                @endif

                <div class="border-b border-stone-200 pb-5">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-sm font-semibold text-stone-500">{{ $vehicle->brand }} {{ $vehicle->model }} - {{ $vehicle->location }}</p>
                        @if($vehicle->is_verified)
                            <span class="rounded bg-emerald-100 px-2 py-1 text-xs font-black text-emerald-700">Verified</span>
                        @endif
                    </div>
                    <p class="mt-3 text-3xl font-black text-stone-950">{{ $vehicle->price ? 'Rp '.number_format($vehicle->price, 0, ',', '.') : 'Harga by request' }}</p>
                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded bg-stone-100 p-3">
                            <p class="font-semibold text-stone-500">Tahun</p>
                            <p class="font-black text-stone-950">{{ $vehicle->year ?? '-' }}</p>
                        </div>
                        <div class="rounded bg-stone-100 p-3">
                            <p class="font-semibold text-stone-500">Hour meter</p>
                            <p class="font-black text-stone-950">{{ number_format($vehicle->hour_meter ?? 0) }} HM</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('vehicles.inquiry', $vehicle) }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-bold text-stone-700">Nama</label>
                        <input name="name" value="{{ old('name', auth()->user()->name ?? '') }}" class="mt-1 w-full rounded border-stone-300 bg-white text-stone-950 focus:border-amber-500 focus:ring-amber-500" required>
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm font-bold text-stone-700">Perusahaan</label>
                        <input name="company" value="{{ old('company', auth()->user()->company ?? '') }}" class="mt-1 w-full rounded border-stone-300 bg-white text-stone-950 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-bold text-stone-700">Email</label>
                            <input name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="mt-1 w-full rounded border-stone-300 bg-white text-stone-950 focus:border-amber-500 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="text-sm font-bold text-stone-700">WhatsApp</label>
                            <input name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="mt-1 w-full rounded border-stone-300 bg-white text-stone-950 focus:border-amber-500 focus:ring-amber-500" required>
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <input name="budget" value="{{ old('budget') }}" class="rounded border-stone-300 bg-white text-stone-950 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500" placeholder="Budget">
                        <input name="project_location" value="{{ old('project_location') }}" class="rounded border-stone-300 bg-white text-stone-950 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500" placeholder="Lokasi proyek">
                    </div>
                    <textarea name="message" rows="4" class="w-full rounded border-stone-300 bg-white text-stone-950 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500" placeholder="Kebutuhan, jadwal inspeksi, atau catatan negosiasi">{{ old('message') }}</textarea>
                    <button class="w-full rounded bg-amber-500 px-5 py-3 font-black text-stone-950 shadow-sm hover:bg-amber-400">Minta Penawaran</button>
                </form>
            </aside>
        </div>
    </section>

    @if($relatedVehicles->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-black text-stone-950">Unit terkait</h2>
            <div class="mt-5 grid gap-5 md:grid-cols-3">
                @foreach($relatedVehicles as $relatedVehicle)
                    <a href="{{ route('vehicles.show', $relatedVehicle) }}" class="rounded-lg border border-stone-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                        <img class="h-40 w-full rounded object-cover" src="{{ $relatedVehicle->imageUrl() }}" alt="{{ $relatedVehicle->name }}">
                        <p class="mt-3 font-black text-stone-950">{{ $relatedVehicle->name }}</p>
                        <p class="text-sm text-stone-500">{{ $relatedVehicle->location }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.public>
