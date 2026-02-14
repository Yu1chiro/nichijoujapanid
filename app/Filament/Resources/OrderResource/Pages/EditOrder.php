<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Services\ImageKitService;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Sama seperti create, cek jika user mengupload gambar baru (Base64)
        if (isset($data['payment_proof']) && str_starts_with($data['payment_proof'], 'data:image')) {
            $data['payment_proof'] = ImageKitService::upload($data['payment_proof'], 'proof_edit_' . $data['customer_name']);
        }

        return $data;
    }
}