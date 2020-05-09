<?php
/* @var $this yii\web\View */

use modules\entrant\helpers\PassportDataHelper;
use modules\entrant\helpers\AddressHelper;
use modules\entrant\helpers\DocumentEducationHelper;
use \olympic\helpers\auth\ProfileHelper;
use yii\helpers\Html;
/* @var $user_id integer */
/* @var  $profile array */
/* @var $anketa array */


$passport = PassportDataHelper::dataArray($user_id);
$actual = AddressHelper::actual($user_id);
$reg= AddressHelper::registrationResidence($user_id);
$education = DocumentEducationHelper::dataArray($user_id);
?>

<table width="100%" style="font-family: 'Times New Roman'; font-size: 9px">
    <tr>
        <td><?=Html::img(\Yii::$app->params["staticPath"]."/img/incoming/logo.svg")?></td>
        <td valign="top" align="right"><p><strong>Ректору<br/>
                    федерального государственного бюджетного образовательного учреждения высшего образования<br/>
                    «Московский педагогический государственный университет»<br/>
                    А.В.Лубкову
                </strong></p></td>
    </tr>
</table>

<table width="100%" style="font-family: 'Times New Roman'; font-size: 10px; margin-top: 10px">
    <tr>
        <td width="50%">Фамилия: <?= $profile['last_name'] ?><br/><br/>Имя: <?= $profile['first_name'] ?></td>
        <td>
        </td>
    </tr>
    <tr>
        <td><br/><?=$profile['patronymic'] ? "Отчество: ". $profile['patronymic'] : "";?><br/><br/>
            Дата рождения: <?= $passport['date_of_birth'] ?>
        </td>
        <td>
        </td>
    </tr>
    <tr>
        <td>
            Контактный телефон: <?= $profile['phone'] ?>
            <br/><br/>
            E-mail: <?= $profile['email'] ?>
        </td>
        <td>Документ, удостоверяющий личность: <?= $passport['type'] ?> <br />
            серия:<?= $passport['series'] ?> <?= $passport['number'] ?>  <br />
            выдан: <?= $passport['authority'] ?>  <br />
            <?= $passport['date_of_issue'] ?>  <br />
            <?= $passport['division_code'] ?  "Код подраздедения: ".$passport['division_code'] : "" ?></td>
    </tr>
    <tr>
        <td>Гражданство: <?= $passport['nationality'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">
            <br/><br/>
            <?=$profile["gender"] == ProfileHelper::genderName(ProfileHelper::MALE)
                ? "окончившего" : "окончившей"?> <?= $education['year']." году ".$education['school_id']." <strong>"
            .$education['series']." ".$education['number']."</strong>"." (".$education['schoolCountyRegion'].")"?>
        </td>
    </tr>
</table>


