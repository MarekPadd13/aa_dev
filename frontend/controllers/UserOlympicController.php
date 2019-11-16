<?php


namespace frontend\controllers;

use olympic\models\OlimpicList;
use olympic\services\UserOlimpiadsService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class UserOlympicController extends Controller
{
    private $service;

    public function __construct($id, $module, UserOlimpiadsService $service,  $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionRegistration($id, $home)
    {
        $this->isGuest();
        try {
            $this->service->add($id, Yii::$app->user->id);
            Yii::$app->session->setFlash('success', 'Спасибо за регистрацию.');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['olympiads/registration-on-olympiads', 'id' => $home]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $home)
    {
        $this->isGuest();
        try {
            $this->service->remove($id, Yii::$app->user->id);
            Yii::$app->session->setFlash('success', 'Успешно отменена');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['olympiads/registration-on-olympiads', 'id' => $home]);
    }

    protected function isGuest() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['dod/index']);
        }
    }
}