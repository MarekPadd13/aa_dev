<?php


namespace dictionary\models;


use dictionary\forms\DictCompetitiveGroupCreateForm;
use dictionary\forms\DictCompetitiveGroupEditForm;
use dictionary\helpers\DictCompetitiveGroupHelper;
use dictionary\models\queries\DictCompetitiveGroupQuery;
use dictionary\models\Faculty;
use dictionary\models\DictSpeciality;
use yii\db\ActiveRecord;

class DictCompetitiveGroup extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dict_competitive_group';
    }


    public static function create(DictCompetitiveGroupCreateForm $form, $faculty_id, $speciality_id, $specialization_id)
    {
        $competitiveGroup = new static();
        $competitiveGroup->speciality_id = $speciality_id;
        $competitiveGroup->specialization_id = $specialization_id;
        $competitiveGroup->education_form_id = $form->education_form_id;
        $competitiveGroup->financing_type_id = $form->financing_type_id;
        $competitiveGroup->faculty_id = $faculty_id;
        $competitiveGroup->kcp = $form->kcp;
        $competitiveGroup->special_right_id = $form->special_right_id;
        $competitiveGroup->passing_score = $form->passing_score;
        $competitiveGroup->is_new_program = $form->is_new_program;
        $competitiveGroup->only_pay_status = $form->only_pay_status;
        $competitiveGroup->competition_count = $form->competition_count;
        $competitiveGroup->education_duration = $form->education_duration;
        $competitiveGroup->education_year_cost = $form->education_year_cost;
        $competitiveGroup->discount = $form->discount;
        $competitiveGroup->enquiry_086_u_status = $form->enquiry_086_u_status;
        $competitiveGroup->spo_class = $form->spo_class;
        $competitiveGroup->ais_id = $form->ais_id;
        $competitiveGroup->link = $form->link;
        $competitiveGroup->year = $form->year;
        $competitiveGroup->foreigner_status = $form->foreigner_status;
        return $competitiveGroup;
    }

    public function edit(DictCompetitiveGroupEditForm $form, $faculty_id, $speciality_id, $specialization_id)
    {
        $this->speciality_id = $speciality_id;
        $this->specialization_id = $specialization_id;
        $this->education_form_id = $form->education_form_id;
        $this->financing_type_id = $form->financing_type_id;
        $this->faculty_id = $faculty_id;
        $this->kcp = $form->kcp;
        $this->special_right_id = $form->special_right_id;
        $this->passing_score = $form->passing_score;
        $this->is_new_program = $form->is_new_program;
        $this->only_pay_status = $form->only_pay_status;
        $this->competition_count = $form->competition_count;
        $this->education_duration = $form->education_duration;
        $this->education_year_cost = $form->education_year_cost;
        $this->discount = $form->discount;
        $this->enquiry_086_u_status = $form->enquiry_086_u_status;
        $this->spo_class = $form->spo_class;
        $this->ais_id = $form->ais_id;
        $this->link = $form->link;
        $this->year = $form->year;
        $this->foreigner_status = $form->foreigner_status;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'speciality_id' => 'Направление подготовки',
            'specialization_id' => 'Образовательная программа',
            'education_form_id' => 'Форма обучения',
            'financing_type_id' => 'Вид финансирования',
            'faculty_id' => 'Факультет',
            'kcp' => 'КЦП',
            'special_right_id' => 'Квота /целевое',
            'competition_count' => 'Конкурс',
            'passing_score' => 'Проходной балл',
            'link' => 'Ссылка на ООП',
            'is_new_program' => 'Новая программа',
            'only_pay_status' => 'Только на платной основе',
            'education_duration' => 'Срок обучения',
            'year' => 'Учебный год',
            'education_year_cost' => 'Стоимость обучения за год',
            'discount' => 'Скидка',
            'enquiry_086_u_status' => 'Требуется справка 086-у',
            'spo_class' => 'Класс СПО',
            'ID  АИС ВУЗ' => 'ais_id',
            'Конкурсная группа УМС' => 'foreigner_status',
        ];
    }

    public static function labels(): array
    {
        $competitiveGroup = new static();
        return $competitiveGroup->attributeLabels();
    }

    public function getFaculty()
    {
        return $this->hasOne(Faculty::class, ['id' => 'faculty_id']);
    }

    public function getExaminations()
    {
        return $this->hasMany(DisciplineCompetitiveGroup::class, ['competitive_group_id' => 'id']);
    }

    public
    function getSpecialization()
    {
        return $this->hasOne(DictSpecialization::class, ['id' => 'specialization_id']);
    }

    public
    function getSpecialty()
    {
        return $this->hasOne(DictSpeciality::class, ['id' => 'speciality_id']);
    }

    public
    static function find(): DictCompetitiveGroupQuery
    {
        return new DictCompetitiveGroupQuery(static::class);
    }

    public static function findBudgetAnalog($cgContract): array
    {
        $cgBudget = self::find()->findBudgetAnalog($cgContract)->one();

        if ($cgBudget) {
            return [
                "status" => 1,
                "cgBudgetId" => $cgBudget->id,
                "cgContractId" => $cgContract->id,
                "kcp" => $cgBudget->kcp,
                "competition_count" => $cgBudget->competition_count,
                "passing_score" => $cgBudget->passing_score,

            ];
        }
        return [
            "status" => 0,
            "cgContractId" => $cgContract->id,
            "kcp" => "прием только на платной основе",
            "competition_count" => null,
            "passing_score" => null,
        ];
    }


    public static function findCg($facultyId, $specialtyId, $specializationId, $educationFormId, $financingTypeId,
                                  $year, $specialtyRight, $foreignerStatus, $spoClass)
    {

        $cg = self::find()
            ->andWhere(['faculty_id' => $facultyId])
            ->andWhere(['speciality_id' => $specialtyId])
            ->andWhere(['specialization_id' => $specializationId])
            ->andWhere(['education_form_id' => $educationFormId])
            ->andWhere(['financing_type_id' => $financingTypeId])
            ->andWhere(['special_right_id' => $specialtyRight])
            ->andWhere(['foreigner_status' => $foreignerStatus])
            ->andWhere(['spo_class' => $spoClass])
            ->andWhere(['year' => $year])->one();
        return $cg;
    }

    public static function aisToSdoEduLevelConverter($key)
    {
        switch ($key) {
            case 1 :
                return DictCompetitiveGroupHelper::EDUCATION_LEVEL_BACHELOR;
                break;
            case 4 :
                return DictCompetitiveGroupHelper::EDUCATION_LEVEL_MAGISTER;
                break;
            case 5 :
                return DictCompetitiveGroupHelper::EDUCATION_LEVEL_SPO;
                break;
            case 6 :
                return DictCompetitiveGroupHelper::EDUCATION_LEVEL_GRADUATE_SCHOOL;
                break;

        }
    }

    public static function aisToSdoEduFormConverter($key)
    {
        switch ($key) {
            case 1 :
                return DictCompetitiveGroupHelper::EDU_FORM_OCH;
                break;
            case 2 :
                return DictCompetitiveGroupHelper::EDU_FORM_ZAOCH;
                break;
            case 3 :
                return DictCompetitiveGroupHelper::EDU_FORM_OCH_ZAOCH;
                break;
        }
    }


    public static function aisToSdoYearConverter()
    {
        return [
            2020 => "2019-2020",
            2019 => "2018-2019",
            2018 => "2017-2018",
        ];
    }


}