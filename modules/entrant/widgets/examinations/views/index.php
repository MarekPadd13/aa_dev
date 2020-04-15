<?php
/* @var $this yii\web\View */
/* @var $model modules\entrant\forms\ExaminationOrCseForm */

use kartik\switchinput\SwitchInput;
use yii\bootstrap\ActiveForm;
use modules\dictionary\helpers\DictCseSubjectHelper;
use yii\helpers\Html;
?>
<div>
    <h4>Вступительные испытания (ВИ) /EГЭ</h4>
    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr><th>#</th><th>Cписок дисциплин</th><th>Вступительное испытание (ВИ) /EГЭ</th><th>Год сдачи ЕГЭ</th> <th>Балл ЕГЭ</th><th></th</tr>
        <?php $a=1; foreach($model->arrayMark as $i => $item): //@TODO неизвестная переменная?>
            <tr>
                <td><?= $a++; ?></td>
                <td><?= $item->str; ?></td>
                <td><?= $form->field($item, "[$i]type")->label(false)->widget(SwitchInput::class, [
                        'pluginOptions' => [
                            'onColor' => 'success',
                            'offColor' => 'primary',
                            'onText'=>'ЕГЭ',
                            'offText'=>'ВИ'
                        ],
                        'pluginEvents' => [
                            "switchChange.bootstrapSwitch" => "function(item) { 
             if($(item.currentTarget).is(':checked')){
                  $('#typeexaminationsform-" . $i . "-language').prop('disabled', false);
                  $('#typeexaminationsform-" . $i . "-year').prop('disabled', false);
                 $('#typeexaminationsform-" . $i . "-mark').prop('disabled', false);
             }else{ 
             $('#typeexaminationsform-" . $i . "-language').prop('disabled', true);
                $('#typeexaminationsform-" . $i . "-year').prop('disabled', true);
                 $('#typeexaminationsform-" . $i . "-mark').prop('disabled', true);
                  $('#typeexaminationsform-" . $i . "-mark').val('');
                   $('#typeexaminationsform-" . $i . "-year').val('');
                } 
         }", "init.bootstrapSwitch" =>  "$('#typeexaminationsform-" . $i . "-type').trigger('switchChange.bootstrapSwitch')",]
                    ]);?></td>
                <td><?= $form->field($item,"[$i]year")->label(false)->textInput(['disabled' => true]) ?></td>
                <td>
                    <?php if($i == $item::LANGUAGE): ?>
                    <?= $form->field($item,"[$i]language")->label(false)->dropDownList(DictCseSubjectHelper::listLanguage(),['disabled' => true]) ?>
                    <?php endif; ?>
                    <?= $form->field($item,"[$i]mark")->label(false)->textInput(['disabled' => true]) ?>
                </td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?= Html::activeHiddenInput($model, 'id') ?>
    <?=  Html::submitButton('Сохранить',['class'=>'btn btn-primary']) ; ?>
    <?php ActiveForm::end(); ?>
    </div>
