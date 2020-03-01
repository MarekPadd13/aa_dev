<?php
/* @var $this yii\web\View */
/* @var $model modules\entrant\forms\PassportDataForm */
$this->title = "Паспортные данные. Добавление.";

$this->params['breadcrumbs'][] = ['label' => 'Онлайн-регистрация', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?= $this->render('_form', ['model'=> $model] )?>
