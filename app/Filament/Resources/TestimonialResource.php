<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Testimonials';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Client Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Client')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('origin')
                            ->label('Asal (Kota/Instansi)')
                            ->placeholder('Contoh: Jakarta / Universitas Indonesia')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('product_purchased')
                            ->label('Produk Dibeli')
                            ->placeholder('Contoh: Paket JLPT N3')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Testimonial Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Isi Testimoni')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                            ])
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website?')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('product_purchased')
                    ->label('Produk')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('origin')
                    ->label('Asal')
                    ->icon('heroicon-m-map-pin')
                    ->color('gray'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}