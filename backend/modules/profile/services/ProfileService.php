<?php

namespace backend\modules\profile\services;

use backend\modules\profile\repository\ProfileRepository;

class ProfileService
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = new ProfileRepository();
    }
    private function checkAccess($userId){
        if(\Yii::$app->user->identity->id !== $userId && !\Yii::$app->user->can('admin')){
            throw new \DomainException('You are not allowed to perform this action.');
        }
    }
    public function getProfile($id)
    {
        $profile = $this->profileRepository->findById($id);
        $this->checkAccess($profile->user_id);
        return $profile;
    }
    public function getAll()
    {
        return $this->profileRepository->getAll();
    }

    public function create($data)
    {
        return $this->profileRepository->create($data);
    }
    public function update($id, $data)
    {
        $profile = $this->profileRepository->findById($id);
        $this->checkAccess($profile->user_id);
        return $this->profileRepository->update($id, $data);
    }
    public function delete($id)
    {
        $profile = $this->profileRepository->findById($id);
        $this->checkAccess($profile->user_id);
        return $this->profileRepository->delete($id);
    }

}