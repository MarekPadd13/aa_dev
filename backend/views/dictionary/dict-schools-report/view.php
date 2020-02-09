<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $school dictionary\models\DictSchoolsReport */
/* @var $isAdd boolean */

$title = $isAdd ? " Поиск и добавление": " Просмотр";
$this->title = $school->name. $title;
$this->params['breadcrumbs'][] = ['label' => 'Учебные организации. Для отчетов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="school-view">
        <div class="box">
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $school,
                    'attributes' => [
                        'id',
                        'name',
                        'email:email',
                        ['attribute' => 'country_id',
                            'value' => \dictionary\helpers\DictCountryHelper::countryName($school->country_id),
                        ],
                        ['attribute' => 'region_id',
                            'value' =>  \dictionary\helpers\DictRegionHelper::regionName($school->region_id),
                        ],
                        'status'
                    ],
                ]) ?>
            </div>
        </div>
    </div>
 <?php if(!$isAdd) : ?>
  <?= Html::a("Поиск и добавить", ['add', 'id'=> $school->id],['class'=>"btn btn-success"]) ?>
 <?php else: ?>
    <?= Html::a("Вернуться", ['view', 'id'=> $school->id],['class'=>"btn btn-primary"]) ?>
 <?php endif; ?>
<?= \backend\widgets\dictionary\DictSchoolsWidget::widget(['model' =>$school, 'isAdd' => $isAdd]) ?>