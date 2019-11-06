<?php


namespace common\auth\services;

use Yii;
use common\auth\forms\SignupForm;
use common\auth\models\User;
use common\auth\repositories\UserRepository;
use common\transactions\TransactionManager;
use yii\base\InvalidArgumentException;

class SignupService
{
    private $users;
    private $transaction;

    public function __construct(
        UserRepository $users,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form): void
    {
        $this->transaction->wrap(function () use ($form) {
            $user = $this->newUser($form);
            $this->users->save($user);
            $this->sendEmail($user);
        });
    }

    public function newUser(SignupForm $form): User
    {
        $user = User::requestSignup($form);
        return $user;
    }

    public function confirm($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }
        $user = $this->users->getByVerificationToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }


    /**
     * Sends confirmation email to user
     * @param \common\auth\models\User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function sendEmail(\common\auth\models\User $user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Аккуант зарегистрирован!' . Yii::$app->name)
            ->send();
    }
}