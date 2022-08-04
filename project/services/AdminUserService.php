<?php

namespace app\services;

use app\models\Role;
use app\models\RoleUser;
use app\models\User;
use Exception;
use Yii;
use yii\data\Pagination;

class AdminUserService extends BaseUserService
{
    public function getUsersListWithPaginator(): bool|array
    {
        try {
            $query = User::find();

            $pagination = new Pagination([
                'defaultPageSize' => Yii::$app->params['adminUsersPerPage'],
                'totalCount' => $query->count()
            ]);

            $users = $query->orderBy(['created_at' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit);

            return [$users, $pagination];
        } catch (Exception) {
            return false;
        }
    }

    public function getOtherRoles(int $id): \yii\db\ActiveQuery|bool
    {
        $user = $this->findUser($id);
        try {
            return Role::find()->where(['not in', 'id', $user->roles()->select('id')->all()]);
        } catch (Exception) {
            return false;
        }
    }

    public function deleteUser(int $id): bool
    {
        try {
            $user = $this->findUser($id);
            $user->delete();
            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function addRole (?int $roleId, int $userId): bool
    {
        if (is_null($roleId)) return false;
        $role = Role::find()->where(['id' => $roleId]);
        if (is_null($role)) return false;
        $roleUser = new RoleUser();
        $roleUser->setUserId($userId);
        $roleUser->setRoleId($roleId);
        $roleUser->save();
        return true;
    }

    public function removeRole(int $roleId, int $userId): bool
    {
        try {
            RoleUser::find()->where(['role_id' => $roleId, 'user_id' => $userId])->one()->delete();
            return true;
        } catch (Exception) {
            return false;
        }
    }
}