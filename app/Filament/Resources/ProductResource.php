<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('category')
                    ->options([
                        'PDF' =>'PDF',
                        'Kanji' =>'Kanji',
                        'Kosakata' =>'Kosakata',
                        'Flashcards' =>'Flashcards',
                        'JLPT' => 'JLPT',
                        'JFT' => 'JFT',
                        'SSW' => 'SSW',
                        'Prompt' => 'Prompt',
                    ])
                    ->required(),
                
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('IDR')
                    ->required(),
                    
                // UBAH DISINI: Logic Diskon jadi Persen
                Forms\Components\TextInput::make('discount')
                    ->numeric()
                    ->label('Diskon (%)') // Label jelas
                    ->suffix('%')         // Tambah simbol persen
                    ->maxValue(100)       // Validasi maksimal 100%
                    ->minValue(0)
                    ->default(0),

                Forms\Components\TextInput::make('product_link')
                ->label('Link File Produk (G-Drive/Download)')
                ->url()
                ->helperText('Link ini akan dikirim otomatis ke email user setelah order diapprove.')
                ->columnSpanFull(),
                
                Forms\Components\Repeater::make('image_urls')
                    ->label('Product Images (Gallery)')
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->label('Image URL')
                            ->url()
                            ->required()
                            ->placeholder('https://ik.imagekit.io/...')
                            ->columnSpanFull(),
                    ])
                    ->grid(2)
                    ->columnSpanFull()
                    ->required(),

                Forms\Components\RichEditor::make('description')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_url') 
                    ->label('Cover')
                    ->size(50),
                
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sales_count')
                ->label('Terjual')
                ->icon('heroicon-m-shopping-bag')
                ->sortable() // Bisa diurutkan (Best Seller)
                ->alignCenter()
                ->badge()
                ->color('success'),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('price')->money('IDR'),
                
                
                // UBAH DISINI: Tampilkan persen
                Tables\Columns\TextColumn::make('discount')
                    ->label('Diskon')
                    ->formatStateUsing(fn ($state) => $state > 0 ? $state . '%' : '-'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}