<?php
/* @var $this yii\web\View */
/* @var $gender string */

/* @var $profile array */

/* @var $passport array */

/* @var $education array */

/* @var $name \common\auth\models\DeclinationFio */

/* @var $cg array */


/* @var $statementConsent modules\entrant\models\StatementConsentCg */
?>
<div class="mt-200 fs-15">
    <p align="center"><strong>Заявление</strong></p>


    <p align="justify" class="lh-1-5">
        Я, <?= $name->nominative ?>, <?= $passport['date_of_birth'] ?> года рождения
        <?= $profile['gender'] == "мужской" ? "согласен" : "согласна" ?>
        на зачисление на 1 курс в <?= $cg['faculty'] ?>.
    </p>

    <?php $educationDocument = "серия: ".$education['series']." номер: ".$education['number'].", выданный: "
        .$education['school_id'].", год выдачи: ".$education['year']?>

    <p><strong>Направление подготовки:</strong> <?= $cg['specialty'] ?></p>
    <?php
    if ($cg['education_level'] == \dictionary\helpers\DictCompetitiveGroupHelper::EDUCATION_LEVEL_BACHELOR)
    {
        $specialization = "<p><strong>Профиль бакалавриата: </strong>" . $cg['specialization'].".";
    }elseif ($cg['education_level'] == \dictionary\helpers\DictCompetitiveGroupHelper::EDUCATION_LEVEL_MAGISTER)
    {
        $specialization = "<p><strong>Магистерская программа: </strong>" . $cg['specialization'].".";
    }
    elseif ($cg['education_level'] == \dictionary\helpers\DictCompetitiveGroupHelper::EDUCATION_LEVEL_GRADUATE_SCHOOL)
    {
        $specialization = "<p><strong>Основная профессиональная образовательная программа: </strong>" . $cg['specialization'].".";
    }else{
        $specialization = "";
    }
    ?>

    <?=$specialization?>

    <p><strong>Форма обучения:</strong> <?= $cg['edu_form'] ?>.</p>

    <p><strong>Вид финансирования:</strong> <?= $cg['financing_type_id'] ?>.</p>
        <?php
        $is086 = "";
        if($cg['is086']){
            $is086 = " и медицинскую справку по форме 0-86У";
        }?>

    <p align="justify" class="lh-1-5">
        После зачисления в МПГУ в течение первого учебного года обязуюсь
        <?php if($cg['financing_type_id'] == "Бюджет"):?>
        <?=$cg['foreigner_status'] ?
            " предоставить в отдел по работе с иностранными учащимися оригинал и 
            нотариально заверенный перевод документа об образовании $educationDocument$is086." :
        " предоставить в отдел студенческого учета и делопроизводства оригинал документа об образовании $educationDocument$is086."?>
        <?php else :?>
            <?=$cg['foreigner_status'] ?
                " предоставить в отдел по работе с иностранными учащимися, 
            нотариально заверенный перевод документа об образовании $educationDocument$is086." :
                " предоставить оригинал договора об оказании платных образовательных услуг в приемную комиссию МПГУ$is086."?>
        <?php endif;?>
    </p>

    <table width="100%" class="mt-50 fs-15">
        <tr>
            <td></td>
            <td width="15%"><?=date("d.m.Y")?> г.</td>
            <td class="bb" width="35%"></td>
            <td width="30%"><?= $name->nominative ?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td width="15%"></td>
            <td width="35%" class="v-align-top text-center">(подпись поступающего)</td>
            <td width="30%"></td>
            <td></td>
        </tr>
    </table>
</div>

