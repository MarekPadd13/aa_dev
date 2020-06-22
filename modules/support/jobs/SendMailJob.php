<?php
/**
 * @author akiraz@bk.ru
 * @link https://github.com/akiraz2/yii2-ticket-support
 * @copyright 2018 akiraz2
 * @license MIT
 */

namespace modules\support\jobs;

use modules\support\Mailer;
use modules\support\models\Content;
use modules\support\traits\ModuleTrait;
use yii\base\BaseObject;

class SendMailJob extends BaseObject implements \yii\queue\JobInterface
{
    use ModuleTrait;

    public $contentId;

    public function execute($queue)
    {
        $content = Content::findOne(['id' => $this->contentId]);
        if ($content !== null) {
            $email = $content->ticket->user_contact;
            /* send email */
            $subject = \modules\support\ModuleFrontend::t('support', '[{APP} Ticket #{ID}] Re: {TITLE}',
                ['APP' => \Yii::$app->name, 'ID' => $content->ticket->hash_id, 'TITLE' => $content->ticket->title]);

            $this->mailer->sendMessage(
                $email,
                $subject,
                'reply-ticket',
                ['title' => $subject, 'model' => $content]
            );

        }
    }

    protected function getMailer()
    {
        return \Yii::$container->get(Mailer::className());
    }
}