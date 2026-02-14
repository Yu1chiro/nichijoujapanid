<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Filament\Notifications\Notification;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
            // FITUR KHUSUS: RESET DATABASE ID (Truncate)
            Actions\Action::make('reset_orders')
                ->label('Reset & Hapus Semua Order')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Semua Data Order?')
                ->modalDescription('PERINGATAN: Tindakan ini akan menghapus SEMUA data pesanan dan mereset ID kembali ke 1. Data yang dihapus tidak dapat dikembalikan.')
                ->modalSubmitActionLabel('Ya, Hapus Semuanya')
                ->action(function () {
                    // Disable Foreign Key Check untuk menghindari error constraint
                    Schema::disableForeignKeyConstraints();
                    
                    // Truncate Tables (Hapus data & Reset ID)
                    DB::table('order_items')->truncate();
                    DB::table('orders')->truncate();
                    
                    // Khusus SQLite (seperti yang Anda gunakan), sequence harus direset manual
                    if (DB::getDriverName() === 'sqlite') {
                        DB::statement("DELETE FROM sqlite_sequence WHERE name='orders'");
                        DB::statement("DELETE FROM sqlite_sequence WHERE name='order_items'");
                    }

                    Schema::enableForeignKeyConstraints();

                    Notification::make()
                        ->title('Database Order Direset')
                        ->body('Semua data dihapus dan ID kembali ke 1.')
                        ->success()
                        ->send();
                }),
        ];
    }
}