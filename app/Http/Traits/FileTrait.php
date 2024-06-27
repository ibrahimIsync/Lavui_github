<?php

namespace App\Http\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

trait FileTrait
{
    private function uploadImage(object $file, string $folderName, string $oldImage = null, string $extra_name = null): string
    {
        $fileName = time() . "_$extra_name" . "_$folderName." . $file->extension();
        if ($oldImage) {
            $this->deleteImage($oldImage);
        }
        $this->createDirectory("uploaded/$folderName");
        $path = public_path("uploaded/$folderName");
        ($file->extension() == 'gif' || $file->extension() == 'mp4' || $file->extension() == 'webm' || $file->extension() == 'wav' || $file->extension() == 'ogg')
            ? $this->uploadFile($file, $path, $fileName)
            : $this->changeImageExtensionToWebp($file, $path, $fileName);
        return $fileName;
    }

    private function deleteImage(string $image): bool
    {
        $destination = public_path($image);
        return !(File::exists($destination)) || unlink($destination);
    }

    private function changeImageExtensionToWebp(object $image, string $destination, string $fileName): void
    {
        Image::make($image->getRealPath())
            ->encode('webp', 0)
            ->save($destination . "/$fileName", 50);
    }

    private function createDirectory(string $folderName): bool
    {
        $folderName = public_path($folderName);
        if (!File::isDirectory($folderName)) {
            File::makeDirectory($folderName, 0755, true);
        }
        return true;
    }

    private function uploadFile(object $file, string $path, string $fileName): void
    {
        $file->move($path, $fileName);
    }
}
