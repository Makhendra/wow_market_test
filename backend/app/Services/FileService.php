<?php

namespace App\Services;

use App\Image;
use Exception;
use Illuminate\Http\UploadedFile;

class FileService
{
    /**
     * @param string $type
     * @param int $model_id
     * @param UploadedFile $file
     * @return void
     */
    public function saveFile(string $type, int $model_id, UploadedFile $file)
    {
        $path = $file->store("/images/$type/$model_id", ['disk' => 'public']);
        $image = Image::firstOrCreate(['source' => $type, 'source_id' => $model_id], ['path' => $path]);
        $image->update(['path' => $path]);
        /** @TODO delete file */
    }

    /**
     * @param string $type
     * @param int $model_id
     * @return void
     * @throws Exception
     */
    public function deleteFile(string $type, int $model_id): void
    {
        $image = Image::whereSource($type)->whereSourceId($model_id)->firstOrFail();
        /** @TODO delete file */
        $image->delete();
    }
}