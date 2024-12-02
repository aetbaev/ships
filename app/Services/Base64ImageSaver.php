<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class Base64ImageSaver
{
    public function save(string $base64Data): string
    {
        if (!preg_match("/^data:image\/(?<extension>(?:png|gif|jpg|jpeg));base64,(?<image>.+)$/", $base64Data, $matchings)) {
            throw new \InvalidArgumentException('Invalid base64 data');
        }

        $extension = $matchings['extension'];
        $base64Data = $matchings['image'];

        if (!base64_decode($base64Data, true)) {
            throw new \InvalidArgumentException('Invalid base64 data');
        }

        $fileName = uniqid() . '.' . $extension;
        Storage::disk('public')->put($fileName, base64_decode($base64Data));

        return Storage::disk('public')->url($fileName);
    }
}
