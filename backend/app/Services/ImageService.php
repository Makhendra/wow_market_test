<?php

namespace App\Services;

use App\DTO\SourceImageDTO;
use App\Image;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ImageService
{

    /**
     * @param SourceImageDTO $sourceImageDTO
     * @return Image|Builder|Model|object|null
     */
    public function find(SourceImageDTO $sourceImageDTO)
    {
        return Image::sourceModel($sourceImageDTO)->first();
    }

    /**
     * @param SourceImageDTO $sourceImageDTO
     * @param string $path
     * @return void
     */
    public function createOrUpdate(SourceImageDTO $sourceImageDTO, string $path)
    {
        $image = $this->find($sourceImageDTO);

        if ($image) {
            app(FileService::class)->deleteFile($path);
            $image->update(['path' => $path]);
        } else {
            Image::create([
                'source' => $sourceImageDTO->getType(),
                'source_id' => $sourceImageDTO->getModelId(),
                'path' => $path
            ]);
        }
    }

    /**
     * @param SourceImageDTO $sourceImageDTO
     * @return void
     * @throws Exception
     */
    public function delete(SourceImageDTO $sourceImageDTO)
    {
        $image = $this->find($sourceImageDTO);
        if ($image) {
            $image->delete();
        }
    }

}