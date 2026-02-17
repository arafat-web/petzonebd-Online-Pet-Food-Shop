<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get image path with fallback to placeholder
     * @param string $imagePath
     * @return string
     */
    public static function getImagePath($imagePath)
    {
        if (empty($imagePath)) {
            return 'placeholder-img.png';
        }

        // Check if image exists in storage
        if (Storage::disk('public')->exists($imagePath)) {
            return 'storage/' . $imagePath;
        }

        return 'placeholder-img.png';
    }
}
