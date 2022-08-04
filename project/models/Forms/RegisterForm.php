<?php

namespace app\models\Forms;

use app\DTO\RegDTO;
use app\models\User;
use app\services\AuthService;
use yii\base\Model;

/**
 * @property-read User|null $user
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $email;
    private AuthService $authService;

    public function __construct(AuthService $authService, $config = [])
    {
        parent::__construct($config);
        $this->authService = $authService;
    }

    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Имя пользователя обязательно'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Это имя пользователя уже используется'],
            ['username', 'string', 'min' => 5, 'max' => 255, 'message' => 'Имя пользователя должно быть длинее 5 символов и короче 255'],
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Email обязателен'],
            ['email', 'email', 'message' => 'Некорректный email'],
            ['email', 'string', 'max' => 255, 'message' => 'Email должен быть короче 255 символов'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот email уже используется'],
            ['password', 'required', 'message' => 'Пароль обязателен'],
            ['password', 'string', 'min' => 8, 'message' => 'Пароль должен быть длинее 8 символов'],
        ];
    }

    public function register(): ?User
    {
        if ($this->validate()) {
            $regDTO = new RegDTO();
            $regDTO->setUsername($this->username);
            $regDTO->setEmail($this->email);
            $regDTO->setPassword($this->password);
            return $this->authService->register($regDTO);
        }

        return null;
    }
}
