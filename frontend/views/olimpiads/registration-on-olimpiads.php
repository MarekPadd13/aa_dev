<?php
use yii\helpers\Html;
use frontend\widgets\olympictemplates\OlympicTemplatesWidget;
use frontend\widgets\olympicold\OlympicOldWidget;

/* @var $this yii\web\View */
/* @var $olympic olympic\models\Olympic */
/* @var $model olympic\forms\SignupOlympicForm */

$this->title = $olympic->name;
?>
<div class="container-fluid">
    <p align="right"><?= $olympic->olympicOneLast->eduLevelString ?></p>
    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-4"><p align="center"><?= $olympic->olympicOneLast->facultyNameString ?></p></div>
        <div class="col-md-4"><p align="center"><?= $olympic->olympicOneLast->numberOftoursNameString?>
                <br /><?= $olympic->olympicOneLast->onlyMpguStudentsString ?></p></div>
        <div class="col-md-4"><p align="center"><?= $olympic->olympicOneLast->formOfPassageString ?></p></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <p><?= $olympic->olympicOneLast->dateRegStartNameString ?></p>
            <p><?= $olympic->olympicOneLast->dateRegEndNameString ?> </p>
            <p><?= $olympic->olympicOneLast->timeOfDistantsTourNameString ?></p>
            <p><?= $olympic->olympicOneLast->timeStartTourNameString ?></p>
            <p><?= $olympic->olympicOneLast->addressNameString ?></p>
            <p><?= $olympic->olympicOneLast->timeOfTourNameString ?></p>
            <?= $olympic->olympicOneLast->contentString ?>
            <?php if (Yii::$app->user->isGuest && $olympic->olympicOneLast->isOnRegisterOlympic) :?>
                <?= $this->render('_form', ['model' => $model]) ?>
            <?php endif; ?>
        </div>
        <div class="col-md-5">
            <div class="control-panel">
                <?= OlympicTemplatesWidget::widget(['model' => $olympic->olympicOneLast]) ?>
                <a href="/print/olimp-result?olimpId=1">Результаты олимпиады</a><br>
                <?= OlympicOldWidget::widget(['model' => $olympic]) ?>
            </div>
            <p class><a href="olympiads">Посмотреть другие олимпиады &gt;</a></p>
        </div>
    </div>
</div>
