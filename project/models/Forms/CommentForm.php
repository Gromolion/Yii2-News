<?php

namespace app\models\Forms;

use app\services\UserNewsService;
use yii\base\Model;

class CommentForm extends Model
{
    public $text;

    protected UserNewsService $newsService;

    public function __construct(UserNewsService $newsService, $config = [])
    {
        parent::__construct($config);
        $this->newsService = $newsService;
    }

    public function rules(): array
    {
        return [
            [['text'], 'string', 'max' => 400, 'tooLong' => 'Комментарий может быть длиной максимум 400 символов'],
            [['text'], 'required', 'message' => 'Текст комментария не может быть пустым'],
        ];
    }

    public function create(int $newsId): bool
    {
        return $this->newsService->createComment($newsId, $this->text);
    }
}