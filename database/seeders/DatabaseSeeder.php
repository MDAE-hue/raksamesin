<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['super_admin', 'admin', 'sales', 'finance', 'seller', 'buyer'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@raksamesin.test'],
            [
                'name' => 'Admin Raksamesin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
        $admin->syncRoles(['super_admin']);

        $sales = User::updateOrCreate(
            ['email' => 'sales@raksamesin.test'],
            [
                'name' => 'Sales Raksamesin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
        $sales->syncRoles(['sales']);

        $vehicles = [
            [
                'name' => 'Komatsu PC200-8 Excavator',
                'category' => 'Excavator',
                'brand' => 'Komatsu',
                'model' => 'PC200-8',
                'year' => 2019,
                'hour_meter' => 6420,
                'location' => 'Balikpapan',
                'price' => 780000000,
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1581094288338-2314dddb7ece?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=900&q=80',
                ],
                'specifications' => [
                    'Operating weight' => '20 ton',
                    'Bucket capacity' => '0.8 m3',
                    'Engine' => 'Komatsu SAA6D107E-1',
                ],
                'description' => 'Unit siap kerja untuk tambang, perkebunan, dan konstruksi. Kondisi mesin sehat, undercarriage layak pakai, dan dokumen tersedia untuk proses inspeksi.',
            ],
            [
                'name' => 'Caterpillar D6R Bulldozer',
                'category' => 'Bulldozer',
                'brand' => 'Caterpillar',
                'model' => 'D6R',
                'year' => 2017,
                'hour_meter' => 8100,
                'location' => 'Samarinda',
                'price' => 1250000000,
                'is_featured' => true,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1590496793929-36417d3117de?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1517089596392-fb9a9033e05d?auto=format&fit=crop&w=900&q=80',
                ],
                'specifications' => [
                    'Blade' => 'Semi-U',
                    'Power' => '185 HP',
                    'Track' => 'Good condition',
                ],
                'description' => 'Bulldozer kelas produksi untuk pekerjaan land clearing dan hauling road. Tersedia jadwal inspeksi dengan sales Raksamesin.',
            ],
            [
                'name' => 'Hitachi ZW220 Wheel Loader',
                'category' => 'Wheel Loader',
                'brand' => 'Hitachi',
                'model' => 'ZW220',
                'year' => 2020,
                'hour_meter' => 3950,
                'location' => 'Makassar',
                'price' => 980000000,
                'is_verified' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1621886292650-520f76c747d6?auto=format&fit=crop&w=1200&q=80',
                ],
                'specifications' => [
                    'Bucket' => '3.1 m3',
                    'Transmission' => 'Automatic',
                    'Application' => 'Stockpile',
                ],
                'description' => 'Wheel loader untuk stockpile, quarry, dan loading material. Catatan servis dan pengecekan lapangan bisa diminta melalui inquiry.',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::updateOrCreate(
                ['slug' => Str::slug($vehicle['name'])],
                array_merge($vehicle, ['status' => 'available', 'condition' => 'used']),
            );
        }

        Lead::updateOrCreate(
            ['phone' => '081200000001', 'vehicle_id' => Vehicle::first()->id],
            [
                'name' => 'Budi Santoso',
                'company' => 'PT Karya Tambang Nusantara',
                'email' => 'budi@example.com',
                'budget' => 'Rp700 juta - Rp850 juta',
                'project_location' => 'Kutai Kartanegara',
                'message' => 'Butuh unit excavator untuk proyek bulan ini, minta jadwal inspeksi.',
                'assigned_to' => $sales->id,
                'status' => 'contacted',
            ],
        );
    }
}
