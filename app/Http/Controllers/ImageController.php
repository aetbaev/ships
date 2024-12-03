<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(StoreImageRequest $request): JsonResponse
    {
        try {
            $image = $request->file('file');
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('uploads', $image, $fileName);
            $url = Storage::disk('public')->url($path);

            return response()->json([
                'success' => true,
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при зайгрузке файла',
            ], 500);
        }
    }
}
