<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

class PortfolioImageService
{
    public function store(UploadedFile $image): string
    {
        $source = match (strtolower($image->getClientOriginalExtension())) {
            'jpg', 'jpeg' => imagecreatefromjpeg($image->getPathname()),
            'png' => imagecreatefrompng($image->getPathname()),
            'webp' => imagecreatefromwebp($image->getPathname()),
            default => throw new RuntimeException('Format d’image non pris en charge.'),
        };

        if (!$source) {
            throw new RuntimeException('Impossible de lire cette image.');
        }

        $width = imagesx($source);
        $height = imagesy($source);

        $directory = public_path('screen_portfolio');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = Str::uuid()->toString();

        foreach ([400, 800] as $targetWidth) {
            $scale = min(1, $targetWidth / $width);

            $newWidth = (int) round($width * $scale);
            $newHeight = (int) round($height * $scale);

            $resized = imagecreatetruecolor($newWidth, $newHeight);

            imagealphablending($resized, false);
            imagesavealpha($resized, true);

            imagecopyresampled(
                $resized,
                $source,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $width,
                $height
            );

            imagewebp(
                $resized,
                $directory . '/' . $filename . '-' . $targetWidth . '.webp',
                80
            );

            imagedestroy($resized);
        }

        imagedestroy($source);

        return 'screen_portfolio/' . $filename . '-800.webp';
    }

    public function delete(?string $image): void
    {
        if (!$image) {
            return;
        }

        $base = preg_replace('/-800\.webp$/', '', $image);

        foreach (['-400.webp', '-800.webp'] as $suffix) {
            $path = public_path($base . $suffix);

            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
