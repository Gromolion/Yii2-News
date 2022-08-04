<?php

namespace app\models\Forms;

use app\DTO\NewsDTO;
use app\services\AdminNewsService;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class NewsForm extends Model
{
    public $header;
    public $announce;
    public $description;
    public $imageFile;

    protected AdminNewsService $newsService;

    public function __construct(AdminNewsService $newsService, $config = [])
    {
        parent::__construct($config);
        $this->newsService = $newsService;
    }

    public function rules(): array
    {
        return [
            [['header', 'announce', 'description'], 'required', 'message' => 'Поле обязательно'],
            [['header', 'announce', 'description'], 'string', 'min' => 8, 'message' => 'Поле должно быть строкой', 'tooShort' => 'Длина поля должна быть минимум 8 символов'],
            [['header', 'announce', 'description'], 'trim'],
            ['imageFile', 'image', 'checkExtensionByMimeType' => false, 'extensions' => 'gif, jpeg', 'maxWidth' => 300, 'maxHeight' => 300],
        ];
    }

    public function create(): bool
    {
        $newsDTO = new NewsDTO();

        $newsDTO->setHeader($this->header);
        $newsDTO->setAnnounce($this->announce);
        $newsDTO->setDescription($this->description);
        $newsDTO->setUserId(Yii::$app->user->id);
        $newsDTO->setImage(UploadedFile::getInstance($this, 'imageFile') ?? null);
        $newsDTO->setCreatedAt(time());

        return $this->newsService->storeNews($newsDTO);
    }

    public function update(ActiveRecord $news): bool
    {
        $newsDTO = new NewsDTO();

        $newsDTO->setHeader($this->header);
        $newsDTO->setAnnounce($this->announce);
        $newsDTO->setDescription($this->description);
        $newsDTO->setImage(UploadedFile::getInstance($this, 'imageFile') ?? null);
        $newsDTO->setCreatedAt(time());

        return $this->newsService->updateNews($newsDTO, $news);
    }
}
