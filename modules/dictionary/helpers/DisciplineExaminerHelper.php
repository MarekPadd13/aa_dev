<?php


namespace modules\dictionary\helpers;
use dictionary\models\DictDiscipline;
use modules\dictionary\models\DictExaminer;
use modules\dictionary\models\ExaminerDiscipline;

class DisciplineExaminerHelper
{
    public static function listDiscipline() {
        return DictDiscipline::find()->select(['name','id'])
            ->andWhere('id NOT IN (SELECT discipline_id FROM examiner_discipline)')
            ->indexBy('id')->column();
    }

    public static function listDisciplineReserve($ids) {
        return DictDiscipline::find()->select(['name','id'])
            ->andWhere(['id'=> $ids])
            ->indexBy('id')->column();
    }

    public static function listDisciplineExaminer($examinerId) {
        return ExaminerDiscipline::find()->select(['discipline_id'])
            ->andWhere(['examiner_id'=> $examinerId])->column();
    }

    public static function listExaminer() {
        return DictExaminer::find()->select(['fio','id'])
            ->indexBy('id')->column();
    }

}