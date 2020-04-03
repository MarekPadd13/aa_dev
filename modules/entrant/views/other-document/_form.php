<?php
/* @var $model modules\entrant\forms\OtherDocumentForm */
/* @var $form yii\bootstrap\ActiveForm */

use kartik\date\DatePicker;
use modules\dictionary\helpers\DictIncomingDocumentTypeHelper;
use modules\entrant\helpers\DateFormatHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-30">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id'=> 'form-other-documents']); ?>
            <?= $form->field($model, 'type')->dropDownList(DictIncomingDocumentTypeHelper::listType([
                DictIncomingDocumentTypeHelper::TYPE_EDUCATION_PHOTO,
                DictIncomingDocumentTypeHelper::TYPE_EDUCATION_VUZ,
                DictIncomingDocumentTypeHelper::TYPE_DIPLOMA,
                DictIncomingDocumentTypeHelper::TYPE_MEDICINE
            ])) ?>
            <?= $form->field($model, 'series')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'date')->widget(DatePicker::class, DateFormatHelper::dateSettingWidget()); ?>
            <?= $form->field($model, 'authority')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'amount')->textInput() ?>
            <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>