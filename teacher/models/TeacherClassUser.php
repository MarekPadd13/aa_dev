<?php

namespace teacher\models;

use teacher\helpers\UserTeacherJobHelper;
use yii\db\ActiveRecord;

class TeacherClassUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'teacher_user_class';
    }

    public static function create($id_olympic_user)
    {
        $userTeacherJob = new static();
        $userTeacherJob ->user_id = \Yii::$app->user->identity->getId();
        $userTeacherJob ->id_olympic_user = $id_olympic_user;
        return $userTeacherJob;
    }

    public function edit($school_id)
    {
        $this->school_id = $school_id;
        $this->status = UserTeacherJobHelper::DRAFT;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function generateVerificationToken()
    {
        $this->hash = \Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id_olympic_user' => 'ФИО Ученика',
        ];
    }


}