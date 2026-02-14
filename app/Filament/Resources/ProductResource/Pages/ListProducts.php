<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('reset_products')
                ->label('Reset Katalog Produk')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    Schema::disableForeignKeyConstraints();
                    
                    DB::table('products')->truncate();
                    
                    if (DB::getDriverName() === 'sqlite') {
                        DB::statement("DELETE FROM sqlite_sequence WHERE name='products'");
                    }

                    Schema::enableForeignKeyConstraints();
                    
                    // Bersihkan Cache Homepage agar produk kosong langsung terlihat
                    Cache::forget('home_products');

                    Notification::make()->title('Katalog Direset')->success()->send();
                }),
        ];
    }
}