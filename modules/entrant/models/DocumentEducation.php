<?php


namespace modules\entrant\models;

use common\moderation\behaviors\ModerationBehavior;
use common\moderation\interfaces\YiiActiveRecordAndModeration;
use dictionary\helpers\DictSchoolsHelper;
use modules\entrant\forms\DocumentEducationForm;
use modules\entrant\helpers\DateFormatHelper;
use modules\entrant\helpers\dictionary\DictIncomingDocumentTypeHelper;
use modules\entrant\models\queries\DocumentEducationQuery;

/**
 * This is the model class for table "{{%document_education}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $school_id
 * @property integer $type
 * @property string $series
 * @property string $number
 * @property string $date
 * @property string $year
 *
**/

class DocumentEducation extends YiiActiveRecordAndModeration
{
    public function behaviors()
    {
        return ['moderation' => [
            'class'=> ModerationBehavior::class,
            'attributes'=>['school_id','type', 'series', 'number', 'date', 'year']
        ]];
    }

    public static  function create(DocumentEducationForm $form, $school_id) {
        $address =  new static();
        $address->data($form, $school_id);
        return $address;
    }

    public function data(DocumentEducationForm $form, $school_id)
    {
        $this->school_id = $school_id;
        $this->type = $form->type;
        $this->series = $form->series;
        $this->number = $form->number;
        $this->date = DateFormatHelper::formatRecord($form->date);
        $this->year = $form->year;
        $this->user_id = $form->user_id;
    }

    public function getValue($property){
        if ($property == "date") {
            return DateFormatHelper::formatView($this->$property);
            }
          return $this->$property;
    }

    protected function getProperty($property){
        return $this->getAttributeLabel($property).": ".$this->getValue($property);
    }

    public function getDocumentEducationFull(){
        $string = "";
        foreach ($this->getAttributes(null,['user_id', 'type', 'id']) as  $key => $value) {
            if($value) {
                $string .= $this->getProperty($key)." ";
            }
        }
        return $string;
    }

    public static function tableName()
    {
        return "{{%document_education}}";
    }

    public function titleModeration(): string
    {
        return "Документ об образовании";
    }

    public function moderationAttributes($value): array
    {
        return [
            'school_id' => DictSchoolsHelper::schoolName($value),
            'type' => DictIncomingDocumentTypeHelper::typeName(DictIncomingDocumentTypeHelper::TYPE_EDUCATION, $value),
            'series' => $value,
            'number'=> $value,
            'date'=> DateFormatHelper::formatView($value),
            'year'=> $value,
            ];
    }

    public function attributeLabels()
    {
        return [
            'school_id' => 'Учебная организация',
            'type'=>'Тип документа',
            'series'=>'Серия',
            'number'=>'Номер',
            'date'=>'От',
            'year'=>'Год окончания',
        ];
    }

    public static function find(): DocumentEducationQuery
    {
        return new DocumentEducationQuery(static::class);
    }


}