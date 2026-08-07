<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\PaymentMethod;
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
                    ->label('Metode Pembayaran')
                    ->options(PaymentMethod::query()->pluck('name', 'name')) 
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required(),
                    ]),
                    
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
                ViewField::make('payment_proof')->view('filament.forms.components.image-kit-uploader')->label('Upload Bukti Transfer'),
            ]),

            // === FITUR BARU: PILIHAN PENGIRIMAN DI HALAMAN EDIT ===
            Forms\Components\Section::make('Pengaturan Pengiriman (Saat Status Paid/Confirmed)')->schema([
                Forms\Components\Select::make('send_via')
                    ->label('Kirim Akses Produk Via')
                    ->options([
                        'email' => 'Hanya Email (Otomatis dari Sistem)',
                        'wa' => 'Hanya WhatsApp (Membuka Tab Baru)',
                        'both' => 'Keduanya (Email & WhatsApp)',
                    ])
                    ->default('email')
                    ->dehydrated(false) // Penting agar tidak disave ke DB karena ini hanya trigger logic
                    ->visibleOn('edit') // Field ini hanya muncul di halaman Edit
                    ->helperText('Pilih bagaimana link produk dikirim saat Anda klik Simpan.'),
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
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'warning' => 'pending',
                    'success' => 'confirmed',
                    'primary' => 'paid',
                ]),
                Tables\Columns\TextColumn::make('total_price')->money('IDR'),
                Tables\Columns\ImageColumn::make('payment_proof')->label('Proof'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            // === FITUR BARU: URUTKAN TERBARU DI PALING ATAS ===
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('send_wa')
                    ->label('Kirim WA')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->color('success')
                    ->openUrlInNewTab()
                    ->url(function (Order $record) {
                        $phone = (string) $record->customer_phone;
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        $date = $record->created_at->format('d M Y, H:i');
                        $totalPrice = number_format($record->total_price, 0, ',', '.');
                        
                        $text = "Helo *{$record->customer_name}*,\n";
                        $text .= "Terima kasih telah melakukan pembelian di Nichijou Japan ID! Berikut adalah struk pembelian serta link akses produk kamu:\n\n";
                        $text .= "=== *STRUK PEMBELIAN* ===\n";
                        $text .= "*Order ID:* #{$record->id}\n";
                        $text .= "*Tanggal:* {$date}\n";
                        $text .= "*Metode Bayar:* {$record->payment_method}\n";
                        $text .= "=====================\n\n";
                        $text .= "*RINCIAN PRODUK:*\n";
                        foreach ($record->items as $item) {
                            $productLink = $item->product ? $item->product->product_link : 'Link belum tersedia';
                            $harga = number_format($item->product_price, 0, ',', '.');
                            $text .= "Nama Produk: *{$item->product_name}*\n";
                            $text .= " ├ Harga : Rp {$harga}\n";
                            $text .= " ├ Jumlah   : {$item->qty}\n";
                            $text .= " └ Akses Link : {$productLink}\n\n";
                        }
                        $text .= "=====================\n";
                        $text .= "*TOTAL BAYAR: Rp {$totalPrice}*\n";
                        $text .= "=====================\n\n";
                        $text .= "\nUntuk membantu peningkatan layanan Nichijou Japan ID, silakan berikan ulasan terbaik kamu di link berikut ya! ദ്ദി(˵ •̀ ᴗ - ˵ ) ✧\nhttps://tally.so/r/2EYYAe";
                        $text .= "\nありがとうございました。日本語の勉強頑張ってください！. 🎌";

                        return "https://wa.me/{$phone}?text=" . rawurlencode($text);
                    }),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}