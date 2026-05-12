<?php

namespace App\Filament\Resources\Inspections\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InspectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lead_id')
                    ->relationship('lead', 'name')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'name'),
                Select::make('inspector_id')
                    ->relationship('inspector', 'name'),
                DateTimePicker::make('scheduled_at'),
                TextInput::make('location'),
                TextInput::make('status')
                    ->required()
                    ->default('requested'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Textarea::make('attachments')
                    ->columnSpanFull(),
            ]);
    }
}
