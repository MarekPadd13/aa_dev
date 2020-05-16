<?php
use yii\helpers\Html;
use modules\entrant\widgets\file\FileWidget;
use modules\entrant\widgets\file\FileListWidget;
/* @var $statement modules\entrant\models\Statement*/
/* @var $model modules\entrant\models\PassportData*/
?>

<h3>Скан документа, удостоверяющего личность</h3>
<table class="table table-bordered">
    <tr>
        <th>Документ, удостоверяющий личность</th>
        <th>Тип</th>
        <th><?= FileWidget::widget(['record_id' => $model->id, 'model' =>$model::className() ]) ?></th>
    </tr>
    <tr>
        <td>
            <?= $model->passportFull ?>
        </td>
        <td>
            <?= $model->typeName ?>
        </td>
        <td>
            <?= FileListWidget::widget(['record_id' => $model->id, 'model' => $model::className()]) ?>
        </td>
    </tr>

</table>