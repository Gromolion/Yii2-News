<?php

namespace app\services;

use app\DTO\RegDTO;
use app\models\User;

interface AuthServiceInterface
{
    /**
     * Зарегистрировать пользователя
     * @param RegDTO $regDTO
     * @return User|null
     */
    public function register(RegDTO $regDTO): ?User;

    /**
     * Залогинить пользователя
     * @param User $user
     * @param int $rememberTime
     * @return bool
     */
    public function login(User $user, int $rememberTime): bool;

    /**
     * Разлогинить пользователя
     * @return bool
     */
    public function logout(): bool;
}