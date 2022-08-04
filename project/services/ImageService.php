<?php

namespace app\services;

use app\models\Image;
use Yii;
use yii\web\UploadedFile;

class ImageService implements ImageServiceInterface
{
    public function store(UploadedFile $image): ?int
    {
        $imagePath = 'uploads/' . Yii::$app->security->generateRandomString(12) . '.' . explode('/', $image->type)[1];
        $image->saveAs($imagePath);

        $exif = exif_read_data(Yii::$app->basePath . '/web/' . $imagePath);

        $imageRecord = new Image();
        $imageRecord->path = '/' . $imagePath;
        $imageRecord->width = $exif["COMPUTED"]["Width"];
        $imageRecord->height = $exif["COMPUTED"]["Height"];
        $imageRecord->mime = $image->type;
        return ($imageRecord->save()) ? $imageRecord->id : null;
    }

    public function storeFromPath(string $imagePath): ?int
    {
        $absoluteImagePath = Yii::$app->basePath . '/' . $imagePath;
        $exif = exif_read_data($absoluteImagePath);

        $imageRecord = new Image();
        $imageRecord->path = substr($imagePath, 3);
        $imageRecord->width = $exif["COMPUTED"]["Width"];
        $imageRecord->height = $exif["COMPUTED"]["Height"];
        $imageRecord->mime = image_type_to_mime_type(exif_imagetype($absoluteImagePath));
        return ($imageRecord->save()) ? $imageRecord->id : null;
    }
}