<?php

namespace app\controllers\admin;

use app\models\Forms\AddRoleForm;
use app\services\AdminUserService;
use Yii;
use yii\web\Response;

class UsersController extends AdminMasterController
{
    private AdminUserService $userService;

    public function __construct($id, $module, AdminUserService $userService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
    }

    public function actionIndex(): string
    {
        [$users, $pagination] = $this->userService->getUsersListWithPaginator();

        return $this->render('index', ['users' => $users, 'pagination' => $pagination]);
    }

    public function actionShow(int $id): Response|string
    {
        $user = $this->userService->findUser($id);

        if (!$user) {
            $this->setSessionFlash(['error', 'Такого пользователя не существует']);
            return $this->redirect(['admin/users/index']);
        }

        $roles = $this->userService->getOtherRoles($id);

        $model = new AddRoleForm();

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('show', ['user' => $user, 'roles' => $roles, 'model' => $model]);
        }


        $responseFlash = ['success', 'Роль добавлена'];

        if (!$this->addRole($user->getId(), $model->roleId)) {
            $responseFlash = ['error', 'Произошла ошибка'];
        }

        $this->setSessionFlash($responseFlash);

        return $this->redirect(['admin/users/show', 'id' => $user->getId()]);
    }

    public function actionDelete(int $id): Response
    {
        $responseFlash = ['success', 'Пользователь удалён'];

        if (!$this->userService->deleteUser($id)) {
            $responseFlash = ['error', 'Произошла ошибка'];
        }

        $this->setSessionFlash($responseFlash);

        return $this->redirect(['admin/users/index']);
    }

    public function addRole(int $userId, int $roleId): bool
    {
        if (!$this->userService->addRole($roleId, $userId)) {
            return false;
        }
        return true;
    }

    public function actionRemoveRole(int $userId, int $roleId): Response
    {
        $responseFlash = ['success', 'Роль удалена'];

        if (!$this->userService->removeRole($roleId, $userId)) {
            $responseFlash = ['error', 'Произошла ошибка'];
        }

        $this->setSessionFlash($responseFlash);

        return $this->redirect(['admin/users/show', 'id' => $userId]);
    }
}