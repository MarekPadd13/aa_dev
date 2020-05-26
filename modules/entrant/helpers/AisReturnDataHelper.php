<?php


namespace modules\entrant\helpers;

use modules\entrant\models\DocumentEducation;
use modules\entrant\models\OtherDocument;
use modules\entrant\models\PassportData;
use yii\helpers\ArrayHelper;

class AisReturnDataHelper
{
    public static  function typesModel() {
        return [
          1 => PassportData::class,
          2 => OtherDocument::class,
          3 => DocumentEducation::class
        ];
    }

    public static function modelKey($key){
       return ArrayHelper::getValue(self::typesModel(), $key);
    }
}