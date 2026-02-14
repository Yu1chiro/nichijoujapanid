<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('Produk tersedia di katalog')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),

            Stat::make('Total Orders', Order::count())
                ->description('Semua pesanan masuk')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make('Total Revenue', 'IDR ' . number_format(Order::where('status', 'paid')->orWhere('status', 'confirmed')->sum('total_price'), 0, ',', '.'))
                ->description('Pemasukan terkonfirmasi')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}