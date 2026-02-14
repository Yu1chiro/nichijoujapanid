<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Services\ImageKitService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\ViewField;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Customer Info')->schema([
                Forms\Components\TextInput::make('customer_name')->required(),
                Forms\Components\TextInput::make('customer_email')->email()->required()->label('Email Customer'),
                Forms\Components\TextInput::make('customer_phone')->tel(),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'qris' => 'QRIS',
                        'mbanking' => 'M-Banking',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'confirmed' => 'Confirmed',
                    ])
                    ->default('pending')
                    ->required(),
            ]),

            Forms\Components\Section::make('Payment Proof')->schema([
                // CUSTOM COMPONENT: Menerima Base64 dari JS
                ViewField::make('payment_proof')->view('filament.forms.components.image-kit-uploader')->label('Upload Bukti Transfer'),
            ]),

            Forms\Components\Section::make('Items')->schema([
                Forms\Components\Repeater::make('items')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $product = \App\Models\Product::find($state);
                                if ($product) {
                                    $set('product_name', $product->name);
                                    $set('product_price', $product->price);
                                    $set('product_thumbnail', $product->thumbnail_url);
                                }
                            }),

                        // Hidden fields untuk snapshot data
                        Forms\Components\TextInput::make('product_name')->required(),
                        Forms\Components\TextInput::make('product_price')->numeric()->readOnly(),
                        Forms\Components\TextInput::make('qty')
                            ->numeric()
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => $set('subtotal', $state * $get('product_price'))),
                        Forms\Components\TextInput::make('subtotal')->numeric()->readOnly(),
                    ])
                    ->columns(4),
            ]),

            Forms\Components\TextInput::make('total_price')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('customer_name')->searchable(),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'warning' => 'pending',
                    'success' => 'confirmed',
                    'primary' => 'paid',
                ]),
                Tables\Columns\TextColumn::make('total_price')->money('IDR'),
                Tables\Columns\ImageColumn::make('payment_proof')->label('Proof'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()]);
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
