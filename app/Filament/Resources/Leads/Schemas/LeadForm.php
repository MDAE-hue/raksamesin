<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'name'),
                Select::make('buyer_id')
                    ->relationship('buyer', 'name'),
                Select::make('assigned_to')
                    ->relationship('assignee', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('company'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('budget'),
                TextInput::make('project_location'),
                Select::make('status')
                    ->options([
                        'new' => 'Baru',
                        'contacted' => 'Dihubungi',
                        'inspection_scheduled' => 'Inspeksi dijadwalkan',
                        'quotation_sent' => 'Penawaran dikirim',
                        'negotiation' => 'Negosiasi',
                        'deal' => 'Deal',
                        'lost' => 'Batal',
                    ])
                    ->required()
                    ->default('new'),
                Textarea::make('message')
                    ->columnSpanFull(),
                DateTimePicker::make('last_contacted_at'),
            ]);
    }
}
