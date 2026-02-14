<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhatsappNumberResource\Pages;
use App\Models\WhatsappNumber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WhatsappNumberResource extends Resource
{
    protected static ?string $model = WhatsappNumber::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama CS / Divisi'),
                Forms\Components\TextInput::make('whatsapp_number')
                    ->required()
                    ->tel()
                    ->placeholder('6281234567890')
                    ->helperText('Gunakan format internasional tanpa + (cth: 628...)'),
                Forms\Components\Toggle::make('status_active')
                    ->label('Aktifkan Nomor ini?')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('whatsapp_number')->copyable(),
                Tables\Columns\ToggleColumn::make('status_active')->label('Active'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhatsappNumbers::route('/'),
            'create' => Pages\CreateWhatsappNumber::route('/create'),
            'edit' => Pages\EditWhatsappNumber::route('/{record}/edit'),
        ];
    }
}