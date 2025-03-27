<?php

namespace backend\modules\admin\services;

use backend\modules\profile\repository\ProfileRepository;
use backend\modules\user\models\User;
use yii\web\ForbiddenHttpException;
use Yii;
use yii\web\NotFoundHttpException;

class AdminService
{


    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository){
        $this->profileRepository = $profileRepository;
    }

    public function checkAdminAccess()
    {
        if(!Yii::$app->user->can('admin')){
            throw new ForbiddenHttpException('You are not admin');
        }

    }
    public function assignedRole($userId,$roleName)
    {
        $this->checkAdminAccess();
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);

        if(!$role){
            throw new \DomainException('Role not found');
        }
        $auth->revokeAll($userId);
        $auth->assign($role,$userId);

        return true;
    }

    public function getAllUsers()
    {
        $this->checkAdminAccess();
        return User::find()->all();
    }

    public function findUserById($id)
    {
        $this->checkAdminAccess();

        $user= User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException('Пользователь не найден');
        }
        return $user;
    }

    public function updateUser($id,$data)
    {
        $this->checkAdminAccess();
        $user = $this->findUserById($id);

        $user->load($data);

        if (isset($data['role'])) {
            $this->assignedRole($user->id, $data['role']);
        }

        return $user->save();
    }
    public function deleteUserWithProfile($id)
    {
        $this->checkAdminAccess();
        $user = User::findOne($id);

        if(!$user){
            throw new NotFoundHttpException('User not found');
        }
        $profile = $this->profileRepository->findByUserId($id);
        if($profile){
            $this->profileRepository->delete($profile->id);
        }

        Yii::$app->authManager->revokeAll($id);
        $user->delete();

        return true;
    }





    public function getProfiles()
    {
        $this->checkAdminAccess();
        return $this->profileRepository->getAll();
    }
    public function getProfileById($id)
    {
        $this->checkAdminAccess();
        return $this->profileRepository->findById($id);
    }
    public function updateProfile($id,$data)
    {
        $this->checkAdminAccess();
        return $this->profileRepository->update($id, $data);
    }
    public function deleteProfile($id)
    {
        $this->checkAdminAccess();
        $this->profileRepository->delete($id);
        return true;
    }
}