<?php

/* @var $model modules\entrant\forms\DocumentEducationForm */
/* @var $form yii\bootstrap\ActiveForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use modules\entrant\helpers\DateFormatHelper;
use modules\dictionary\helpers\DictIncomingDocumentTypeHelper;
use common\auth\helpers\UserSchoolHelper;
use kartik\date\DatePicker;
\modules\entrant\assets\education\DocumentEducationAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-30">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id'=> 'form-school-user']); ?>
            <?= $form->field($model, 'school_id')->dropDownList(UserSchoolHelper::userSchoolAll(Yii::$app->user->identity->getId())) ?>
            <?= $form->field($model, 'type')->dropDownList(DictIncomingDocumentTypeHelper::listType(DictIncomingDocumentTypeHelper::TYPE_EDUCATION)) ?>
            <?= $form->field($model, 'series')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'date')->widget(DatePicker::class, DateFormatHelper::dateSettingWidget()); ?>
            <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'original')->checkbox() ?>
            <?= $form->field($model, 'fio')->checkbox() ?>
            <div id="no-fio-profile">
                <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
