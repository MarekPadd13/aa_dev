<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use olympic\models\dictionary\CategoryDoc;
use olympic\helpers\dictionary\CategoryDocHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\dictionary\FacultySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории документов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catDoc-index">

    <h1><?= $this->title ?></h1>

    <p>
        <?= Html::a('Cоздать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                     'id',
                     'name',
                    ['attribute' => 'type_id',
                        'filter' => $searchModel->categoryTypeList(),
                        'value' => function (CategoryDoc $model) {
                            return CategoryDocHelper::categoryDocTypeName($model->type_id);
                            },
                    ],
                    ['class' => ActionColumn::class],
                ]
            ]); ?>
        </div>
    </div>
</div>
</div>
