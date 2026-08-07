<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Resources\Pages\CreateRecord;
use App\Services\ImageKitService;
use Illuminate\Support\Str;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['thumbnail_url']) && str_starts_with($data['thumbnail_url'], 'data:image')) {
            $uploadedUrl = ImageKitService::upload($data['thumbnail_url'], 'article_' . Str::slug($data['title']));
            // Force WebP convertion from ImageKit
            $data['thumbnail_url'] = $uploadedUrl . '?tr=f-webp';
        }
        return $data;
    }
}