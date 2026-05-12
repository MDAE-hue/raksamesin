<x-layouts.public title="{{ $vehicle->name }} - Raksamesin">
    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_420px] lg:px-8">
        <div>
            <div class="overflow-hidden border border-white/10 bg-zinc-900">
                <img class="h-[460px] w-full object-cover" src="{{ $vehicle->imageUrl() }}" alt="{{ $vehicle->name }}">
            </div>
            <div class="mt-4 grid grid-cols-3 gap-3">
                @foreach(array_slice($vehicle->images ?? [], 1, 3) as $index => $image)
                    <img class="h-28 w-full border border-white/10 object-cover" src="{{ $vehicle->imageUrl($index + 1) }}" alt="{{ $vehicle->name }}">
                @endforeach
            </div>

            <div class="mt-8">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-400">{{ $vehicle->category }}</p>
                <h1 class="mt-3 text-4xl font-black text-white">{{ $vehicle->name }}</h1>
                <p class="mt-3 text-zinc-300">{{ $vehicle->description }}</p>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-2">
                @foreach(($vehicle->specifications ?? []) as $label => $value)
                    <div class="border border-white/10 bg-zinc-900 p-4">
                        <p class="text-xs uppercase tracking-wide text-zinc-500">{{ $label }}</p>
                        <p class="mt-1 font-semibold text-zinc-100">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <aside class="h-fit border border-white/10 bg-zinc-900 p-5">
            @if(session('status'))
                <div class="mb-5 border border-emerald-500/40 bg-emerald-500/10 p-3 text-sm text-emerald-200">{{ session('status') }}</div>
            @endif

            <div class="border-b border-white/10 pb-5">
                <p class="text-sm text-zinc-400">{{ $vehicle->brand }} {{ $vehicle->model }} • {{ $vehicle->location }}</p>
                <p class="mt-2 text-3xl font-black text-amber-400">{{ $vehicle->price ? 'Rp '.number_format($vehicle->price, 0, ',', '.') : 'Harga by request' }}</p>
                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                    <div class="bg-zinc-950 p-3">
                        <p class="text-zinc-500">Tahun</p>
                        <p class="font-bold">{{ $vehicle->year ?? '-' }}</p>
                    </div>
                    <div class="bg-zinc-950 p-3">
                        <p class="text-zinc-500">Hour meter</p>
                        <p class="font-bold">{{ number_format($vehicle->hour_meter ?? 0) }} HM</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('vehicles.inquiry', $vehicle) }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-semibold text-zinc-200">Nama</label>
                    <input name="name" value="{{ old('name', auth()->user()->name ?? '') }}" class="mt-1 w-full border-zinc-700 bg-zinc-950 text-zinc-100 focus:border-amber-500 focus:ring-amber-500" required>
                    @error('name') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-zinc-200">Perusahaan</label>
                    <input name="company" value="{{ old('company', auth()->user()->company ?? '') }}" class="mt-1 w-full border-zinc-700 bg-zinc-950 text-zinc-100 focus:border-amber-500 focus:ring-amber-500">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="text-sm font-semibold text-zinc-200">Email</label>
                        <input name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="mt-1 w-full border-zinc-700 bg-zinc-950 text-zinc-100 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-zinc-200">WhatsApp</label>
                        <input name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="mt-1 w-full border-zinc-700 bg-zinc-950 text-zinc-100 focus:border-amber-500 focus:ring-amber-500" required>
                        @error('phone') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <input name="budget" value="{{ old('budget') }}" class="border-zinc-700 bg-zinc-950 text-zinc-100 placeholder:text-zinc-500 focus:border-amber-500 focus:ring-amber-500" placeholder="Budget">
                    <input name="project_location" value="{{ old('project_location') }}" class="border-zinc-700 bg-zinc-950 text-zinc-100 placeholder:text-zinc-500 focus:border-amber-500 focus:ring-amber-500" placeholder="Lokasi proyek">
                </div>
                <textarea name="message" rows="4" class="w-full border-zinc-700 bg-zinc-950 text-zinc-100 placeholder:text-zinc-500 focus:border-amber-500 focus:ring-amber-500" placeholder="Kebutuhan, jadwal inspeksi, atau catatan negosiasi">{{ old('message') }}</textarea>
                <button class="w-full bg-amber-500 px-5 py-3 font-black text-zinc-950 hover:bg-amber-400">Minta Penawaran</button>
            </form>
        </aside>
    </section>

    @if($relatedVehicles->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-black text-white">Unit terkait</h2>
            <div class="mt-5 grid gap-5 md:grid-cols-3">
                @foreach($relatedVehicles as $relatedVehicle)
                    <a href="{{ route('vehicles.show', $relatedVehicle) }}" class="border border-white/10 bg-zinc-900 p-4 hover:border-amber-500">
                        <img class="h-40 w-full object-cover" src="{{ $relatedVehicle->imageUrl() }}" alt="{{ $relatedVehicle->name }}">
                        <p class="mt-3 font-bold text-white">{{ $relatedVehicle->name }}</p>
                        <p class="text-sm text-zinc-400">{{ $relatedVehicle->location }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.public>
