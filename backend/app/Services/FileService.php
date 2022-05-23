<?php

namespace App\Services;

use App\Image;
use Exception;
use Illuminate\Http\UploadedFile;
use Storage;

class FileService
{
    const DISK = 'public';

    /**
     * @param string $type
     * @param int $model_id
     * @return string
     */
    private function directoryPathForType(string $type, int $model_id): string
    {
        return "/images/$type/$model_id";
    }

    /**
     * @param string $type
     * @param int $model_id
     * @param UploadedFile $file
     * @return void
     */
    public function saveFile(string $type, int $model_id, UploadedFile $file)
    {
        $path = $file->store($this->directoryPathForType($type, $model_id), ['disk' => self::DISK]);
        $image = Image::sourceModel($type, $model_id)->first();

        if ($image) {
            $this->deleteFile($image->path);
            $image->update(['path' => $path]);
        } else {
            Image::create(['source' => $type, 'source_id' => $model_id, 'path' => $path]);
        }
    }

    /**
     * @param string $type
     * @param int $model_id
     * @return void
     * @throws Exception
     */
    public function deleteFileRelation(string $type, int $model_id): void
    {
        $image = Image::sourceModel($type, $model_id)->firstOrFail();
        $this->deleteFile($image->path);
        $image->delete();
    }

    /**
     * @param string $path
     * @return void
     */
    private function deleteFile(string $path): void
    {
        Storage::disk(self::DISK)->delete($path);
    }
}