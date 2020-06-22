<?php
/**
 * @author akiraz@bk.ru
 * @link https://github.com/akiraz2/yii2-ticket-support
 * @copyright 2018 akiraz2
 * @license MIT
 */

use modules\support\models\Category;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\support\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
$catList = Category::getCatList();
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= count($catList) ? $form->field($model, 'category_id')->dropDownList($catList) : '' ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 8]) ?>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? \modules\support\ModuleFrontend::t('support', 'Create') :
            \modules\support\ModuleFrontend::t('support', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
