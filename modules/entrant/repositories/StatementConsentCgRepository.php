<?php
namespace modules\entrant\repositories;

use modules\entrant\models\StatementConsentCg;
use modules\usecase\RepositoryDeleteSaveClass;

class StatementConsentCgRepository extends RepositoryDeleteSaveClass
{
    public function get($id)
    {
        if (!$model = StatementConsentCg::findOne($id)) {
            return false;
        }
        return  $model;
    }

    public function getFull($id, $userId)
    {
        if (!$model = StatementConsentCg::find()->statementOne($id, $userId)) {
            throw new \DomainException('Заявление о зачислении не найдено.');
        }
        return  $model;
    }

    public function exits($userId, $status)
    {
       return StatementConsentCg::find()->statementStatus($userId, $status)->exists();
    }

}