<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    public static function upload($base64String, $fileName = 'upload')
    {
        if (!$base64String || !str_starts_with($base64String, 'data:image')) {
            return $base64String; // Kembalikan as-is jika itu URL, bukan base64
        }

        $imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );

        $uploadFile = $imageKit->uploadFile([
            'file' => $base64String,
            'fileName' => $fileName . '_' . time(),
            'folder' => '/nichijou_orders' // Folder di ImageKit
        ]);

        if ($uploadFile->error) {
            throw new \Exception('ImageKit Upload Error: ' . $uploadFile->error->message);
        }

        return $uploadFile->result->url;
    }
}