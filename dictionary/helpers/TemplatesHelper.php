<?php


namespace dictionary\helpers;


use dictionary\models\Templates;
use yii\helpers\ArrayHelper;

class TemplatesHelper
{
    const TYPE_dictionary = 1;
    const TYPE_DOCUMENTS = 2;

    public static function typeTemplatesList()
    {
        return [
            self::TYPE_dictionary => 'Для олимпиад',
            self::TYPE_DOCUMENTS => 'Для документов цпк',
        ];
    }

    public static function templatesType()
    {
        return [
            self::TYPE_dictionary, self::TYPE_DOCUMENTS
        ];
    }

    public static function typeTemplateName($key): string
    {
        return ArrayHelper::getValue(self::typeTemplates(), $key);
    }

    public static function templatesList(): array
    {
        return ArrayHelper::map(Templates::find()->all(), "id", 'name');
    }

    public static function templatesName($key): string
    {
        return ArrayHelper::getValue(self::templatesList(), $key);
    }
}