<?php

namespace olympic\services\auth;

use olympic\forms\auth\LoginForm;
use common\auth\models\User;
use common\auth\repositories\UserRepository;
use olympic\repositories\auth\ProfileRepository;
use \olympic\helpers\auth\ProfileHelper;

class AuthService
{
    private $repository;
    private $profileRepository;

    public function __construct(UserRepository $repository, ProfileRepository $profileRepository)
    {
        $this->repository = $repository;
        $this->profileRepository = $profileRepository;
    }

    public function auth(LoginForm $form, $role): \common\auth\models\User
    {
        $user = $this->repository->findByUsernameOrEmail($form->username);
        if (!$user || !$user->validatePassword($form->password)) {
            throw new \DomainException('Неверный логин или пароль.');
        }
//        if (!$user->isActive()) {
//            throw new \DomainException('Ваша учетная запись не подтверждена.
//            Пожалуйста, пройдите по ссылке в письме, которое было Вам ранее отправлено.
//            Если письмо не пришло, то проверьте, пожалуйста, папку Спам.');
//        }

        $roleArray = [];
        if($role == \olympic\helpers\auth\ProfileHelper::ROLE_ENTRANT)
        {
            $roleArray = [ProfileHelper::ROLE_ENTRANT, ProfileHelper::ROLE_STUDENT];
        }else{
            $roleArray  = [$role];
        }

        $profile = $this->profileRepository->getUser($user->id);
        if (!in_array($profile->role, $roleArray)) {
            throw new \DomainException('У Вас нет прав для входа.');
        }
        return $user;
    }

    public function autRbac(LoginForm $form): \common\auth\models\User
    {
        $user = $this->repository->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Неверный логин или пароль.');
        }


        if (!\Yii::$app->authManager->getPermissionsByUser($user->id)) {
            throw new \DomainException('У вас нет прав для входа.');
        }
        return $user;
    }
}