<?php
/* @var $this yii\web\View */
/* @var $model modules\entrant\forms\AddressForm */

$this->title = "Адреса. Редактировние.";
$this->params['breadcrumbs'][] = ['label' => 'Онлайн-регистрация', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', ['model'=> $model] )?>