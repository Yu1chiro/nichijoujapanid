<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true) // Live update saat user selesai ketik nama
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                        // Auto-fill slug hanya saat create baru
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                // FIELD BARU: SLUG
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('URL Produk (SEO Friendly). Contoh: belajar-kanji-pemula'),

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
                
                Forms\Components\TextInput::make('price')->numeric()->prefix('IDR')->required(),
                Forms\Components\TextInput::make('discount')->numeric()->label('Diskon (%)')->suffix('%')->maxValue(100)->default(0),

                Forms\Components\TextInput::make('product_link')
                    ->label('Link File Produk (G-Drive)')
                    ->url()
                    ->columnSpanFull(),
                
                Forms\Components\Repeater::make('image_urls')
                    ->label('Gallery')
                    ->schema([
                        Forms\Components\TextInput::make('url')->label('Image URL')->url()->required()->columnSpanFull(),
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
                Tables\Columns\ImageColumn::make('thumbnail_url')->label('Cover')->size(50),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('URL Slug')->color('gray')->limit(20), // Tampilkan slug
                Tables\Columns\TextColumn::make('sales_count')->label('Terjual')->badge()->color('success'),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('price')->money('IDR'),
                Tables\Columns\TextColumn::make('discount')->formatStateUsing(fn ($state) => $state > 0 ? $state . '%' : '-'),
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

    public static function getRelations(): array { return []; }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}