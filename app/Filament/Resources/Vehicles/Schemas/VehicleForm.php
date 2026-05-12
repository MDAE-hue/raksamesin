<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                TextInput::make('brand')
                    ->required(),
                TextInput::make('model'),
                TextInput::make('year')
                    ->numeric(),
                TextInput::make('hour_meter')
                    ->numeric(),
                TextInput::make('location')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp'),
                Select::make('condition')
                    ->options([
                        'new' => 'Baru',
                        'used' => 'Bekas',
                        'refurbished' => 'Refurbished',
                    ])
                    ->required()
                    ->default('used'),
                Select::make('status')
                    ->options([
                        'available' => 'Available',
                        'reserved' => 'Reserved',
                        'sold' => 'Sold',
                        'draft' => 'Draft',
                    ])
                    ->required()
                    ->default('available'),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_verified')
                    ->required(),
                FileUpload::make('images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('vehicle-images')
                    ->reorderable()
                    ->columnSpanFull(),
                KeyValue::make('specifications')
                    ->keyLabel('Spesifikasi')
                    ->valueLabel('Nilai')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('seller_id')
                    ->relationship('seller', 'name'),
            ]);
    }
}
