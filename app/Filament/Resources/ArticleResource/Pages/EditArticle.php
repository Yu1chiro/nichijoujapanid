<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Resources\Pages\EditRecord;
use App\Services\ImageKitService;
use Illuminate\Support\Str;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['thumbnail_url']) && str_starts_with($data['thumbnail_url'], 'data:image')) {
            $uploadedUrl = ImageKitService::upload($data['thumbnail_url'], 'article_edit_' . Str::slug($data['title']));
            $data['thumbnail_url'] = $uploadedUrl . '?tr=f-webp';
        }
        return $data;
    }
}