<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Models\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Bank / Metode')
                    ->required()
                    ->placeholder('Contoh: BCA / QRIS Nichijou'),

                Forms\Components\Select::make('category')
                    ->label('Kategori Pembayaran')
                    ->options([
                        'qris' => 'QRIS (Scan Code)',
                        'mbanking' => 'M-Banking / Transfer Bank',
                    ])
                    ->required()
                    ->live(), // Agar form di bawahnya bereaksi real-time

                // Input Nomor Rekening (Hanya muncul jika M-Banking)
                Forms\Components\TextInput::make('account_number')
                    ->label('Nomor Rekening')
                    ->visible(fn (Get $get) => $get('category') === 'mbanking')
                    ->required(fn (Get $get) => $get('category') === 'mbanking')
                    ->placeholder('Contoh: 1234567890'),

                // Input Gambar/URL QR (Hanya muncul jika QRIS)
                // Jika Anda ingin upload file langsung, ganti TextInput dengan FileUpload
                Forms\Components\TextInput::make('thumbnail_url')
                    ->label('URL Gambar QRIS / Logo Bank')
                    ->visible(fn (Get $get) => $get('category') === 'qris')
                    ->required(fn (Get $get) => $get('category') === 'qris')
                    ->url()
                    ->placeholder('https://... (Link Gambar QR)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'mbanking',
                        'success' => 'qris',
                    ]),
                Tables\Columns\TextColumn::make('account_number')
                    ->label('No. Rekening')
                    ->default('-'),
                Tables\Columns\ImageColumn::make('thumbnail_url')->label('QR/Logo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentMethods::route('/'),
            'create' => Pages\CreatePaymentMethod::route('/create'),
            'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}