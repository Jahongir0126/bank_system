<?php
namespace backend\modules\profile\repository;

use backend\modules\profile\models\Profile;
use yii\web\NotFoundHttpException;
class ProfileRepository
{

    public function findById($id)
    {
        return Profile::findOne($id) ?? throw new NotFoundHttpException("Profile not found");
    }
    public function findByUserId($userId)
    {
        return Profile::findOne(['user_id' => $userId]);
    }

    public function create($data){

        if (isset($data['Profile']['user_id'])) {
            $existingProfile = $this->findByUserId($data['Profile']['user_id']);
            if ($existingProfile) {
                return ["errors" => ["user_id" => ["Профиль для данного пользователя уже существует"]]];
            }
        }

        $profile =new Profile();
        $profile->load($data);
        if($profile->save()){
            return $profile;
        }
        return ["errors"=>$profile->errors];
    }

    public function update($id,$data){
        $profile = $this->findById($id);
        $profile->load($data);
        if($profile->save()){
            return $profile;
        }
        return ["errors"=>$profile->errors];
    }
    public function delete($id){
        $profile = $this->findById($id);
        $profile->delete();
    }
    public function getAll(){
        return Profile::find()->all();
    }



}