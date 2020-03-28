<?php

namespace frontend\controllers;

use backend\models\AisCg;
use dictionary\models\DictCompetitiveGroup;
use dictionary\models\DictSpeciality;
use dictionary\models\DictSpecialization;
use dictionary\models\Faculty;
use frontend\components\redirect\actions\ErrorAction;
use frontend\components\UserNoEmail;
use olympic\models\auth\Profiles;
use yii\web\Controller;
use Yii;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function beforeAction($action)
    {
        return (new UserNoEmail())->redirect();
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "@frontend/views/layouts/frontPage.php";
        return $this->render('index');
    }

//    public function actionTransformPhone()
//    {
//        set_time_limit(6000);
//        $profile = Profiles::find()->all();
//
//        foreach ($profile as $item) {
//            //$phone = str_replace(array('+', ' ', '(', ')', '-'), '', $item->phone);
//
//            if (stristr($item->phone, "+")) {
//                continue;
//            } else {
//                $item->phone = "+" . $item->phone;
//            }
//
//
//            if (!$item->save()) {
//                throw new \DomainException("ошибка при сохранении");
//            }
//        }
//
//        return "finish";
//    }


    public function actionAisImport($year)
    {
        $allAisCg = AisCg::find()
            ->andWhere(['year' => $year])
            ->all();

        echo count($allAisCg);

        $key = 0;

        foreach ($allAisCg as $aisCg) {
            $sdoCg = DictCompetitiveGroup::findCg(
                Faculty::aisToSdoConverter($aisCg->faculty_id),
                DictSpeciality::aisToSdoConverter($aisCg->specialty_id),
                DictSpecialization::aisToSdoConverter($aisCg->specialization_id),
                DictCompetitiveGroup::aisToSdoEduFormConverter($aisCg->education_form_id),
                $aisCg->financing_type_id,
                DictCompetitiveGroup::aisToSdoYearConverter()[$aisCg->year],
                $aisCg->special_right_id, $aisCg->foreigner_status, $aisCg->spo_class);

            if ($sdoCg !== null) {
                $model = $sdoCg;
            } else {
                $model = new DictCompetitiveGroup();
                };
            $model->speciality_id = DictSpeciality::aisToSdoConverter($aisCg->specialty_id);
            $model->specialization_id = DictSpecialization::aisToSdoConverter($aisCg->specialization_id);
            $model->education_form_id = DictCompetitiveGroup::aisToSdoEduFormConverter($aisCg->education_form_id);
            $model->financing_type_id = $aisCg->financing_type_id;
            $model->faculty_id = Faculty::aisToSdoConverter($aisCg->faculty_id);
            $model->kcp = $aisCg->kcp;
            $model->special_right_id = $aisCg->special_right_id;
            $model->passing_score = $aisCg->competition_mark;
            $model->is_new_program = $aisCg->is_new_status;
            $model->competition_count = $aisCg->competition_count;
            $model->only_pay_status = $aisCg->contract_only_status;
            $model->edu_level = DictCompetitiveGroup::aisToSdoEduLevelConverter($aisCg->education_level_id);
            $model->education_duration = $aisCg->education_duration;
            $model->education_year_cost = $aisCg->education_year_cost;
            $model->discount = $aisCg->discount;
            $model->enquiry_086_u_status = $aisCg->enquiry_086_u_status;
            $model->spo_class = $aisCg->spo_class;
            $model->ais_id = $aisCg->id;
            $model->link = $aisCg->site_url;
            $model->year = DictCompetitiveGroup::aisToSdoYearConverter()[$aisCg->year];
            $model->foreigner_status = $aisCg->foreigner_status;
            $model->save();
            $key++;
            }

        return " Количество итерации: ".$key. " success";
    }


    public function actionClearCache()
    {
        $frontendAssets = Yii::getAlias("@frontend") . "/web/assets";
        $backendAssets = Yii::getAlias("@backend") . "/web/assets";

        self::removeDir($frontendAssets);
        self::removeDir($backendAssets);

        return "Папки assets очищены";
    }

    private static function removeDir($dir)
    {
        foreach (\glob($dir . '/*') as $file) {
            if (\is_dir($file)) {
                self::removeDir($file);
            } else {
                \unlink($file);
            }
        }
    }

}
