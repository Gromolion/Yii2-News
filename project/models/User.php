<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function isAdmin(): bool
    {
        return $this->roles()->where(['name' => 'admin'])->exists();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->password_reset_token;
    }

    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    public function roles(): ActiveQuery
    {
        return $this->hasMany(Role::class, ['id' => 'role_id'])->viaTable('role_user', ['user_id' => 'id']);
    }

    public function news(): ActiveQuery
    {
        return $this->hasMany(News::class, ['user_id' => 'id'])->where(['published' => true]);
    }

    public function summaryViews(): int
    {
        return $this->news()->sum('views');
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function findIdentity(int $id): User|IdentityInterface|null
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken(string $token, $type = null): ?IdentityInterface
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    public function validateAuthKey(string $authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */
    public function setPassword(string $password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}