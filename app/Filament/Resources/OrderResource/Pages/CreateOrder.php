<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Services\ImageKitService;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Cek jika payment_proof berisi data base64 (string panjang)
        if (isset($data['payment_proof']) && str_starts_with($data['payment_proof'], 'data:image')) {
            // Upload ke ImageKit dan ganti data dengan URL hasil upload
            $data['payment_proof'] = ImageKitService::upload($data['payment_proof'], 'proof_' . $data['customer_name']);
        }

        return $data;
    }
}