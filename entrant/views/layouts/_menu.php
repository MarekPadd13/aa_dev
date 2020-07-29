<?php
/* @var $jobEntrant \modules\dictionary\models\JobEntrant */

use dictionary\helpers\DictCompetitiveGroupHelper;
use dictionary\helpers\DictFacultyHelper;
use modules\dictionary\helpers\JobEntrantHelper;
use modules\entrant\helpers\StatementHelper;

if(!Yii::$app->user->isGuest ) {
    $jobEntrant = Yii::$app->user->identity->jobEntrant();
    if($jobEntrant && $jobEntrant->isCategoryCOZ()) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Абитуриенты', 'url' => ['/data-entrant/default/index']],
                ['label' => 'Пот. абитуриенты', 'url' => ['/data-entrant/entrant-potential/index']],
                ['label' => 'Абитуриенты c ОФ', 'url' => ['/data-entrant/default/index-file']],
                ['label' => 'Файлы', 'url' => ['/data-entrant/file/index']],
               \Yii::$app->user->can('moderation') ? ['label' => 'Модерация', 'url' => ['/moderation']] : [],
               \Yii::$app->user->can('ticket') ? ['label' => 'Вопросы от абитуриентов', 'url' => ['/support']] : [],
               \Yii::$app->user->can('edu_school') ? ['label' => 'Учебные организации', 'url' => '#',
                    'items' => [
                        ['label' => 'Список', 'url' => ['/dictionary-module/dict-schools']],
                        ['label' => 'Для отчета', 'url' => ['/dictionary-module/dict-schools-report']],
                    ]] : [],
                \Yii::$app->user->can('proctor') ? ['label' => 'Заявки на экзамен',
                    "items" => [
                        [
                            "label" => 'Новые заявки',
                            "url" => ['/data-exam/exam-statement/index'],
                            "icon" => "table",
                        ],
                        [
                            "label" => 'Мои заявки',
                            "url" => ['/data-exam/exam-statement/my-list'],
                            "icon" => "table",
                        ],
                    ]] : [],
            ]

        );
    }  elseif($jobEntrant && $jobEntrant->isAgreement()) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Абитуриенты', 'url' => ['/data-entrant/default/index']],
                ['label' => 'Договоры', 'url' => ['/data-entrant/agreement-contract/index']],
                ['label' => 'Колледж', 'url' => ['/data-entrant/agreement-contract/index', 'faculty'=> DictFacultyHelper::COLLAGE]],
                ['label' => 'Сергиево-Посадский ', 'url' => ['/data-entrant/agreement-contract/index', 'faculty'=> DictFacultyHelper::SERGIEV_POSAD_BRANCH]],
                ['label' => 'Анапский', 'url' => ['/data-entrant/agreement-contract/index','faculty'=> DictFacultyHelper::ANAPA_BRANCH]],
                ['label' => 'Покровский', 'url' => ['/data-entrant/agreement-contract/index', 'faculty'=> DictFacultyHelper::POKROV_BRANCH]],
                ['label' => 'Ставропольский ', 'url' => ['/data-entrant/agreement-contract/index', 'faculty'=> DictFacultyHelper::STAVROPOL_BRANCH]],
                ['label' => 'Дербентский', 'url' => ['/data-entrant/agreement-contract/index', 'faculty'=> DictFacultyHelper::DERBENT_BRANCH]],
                ['label' => 'Аспирантура', 'url' => ['/data-entrant/agreement-contract/index', 'eduLevel'=> DictCompetitiveGroupHelper::EDUCATION_LEVEL_GRADUATE_SCHOOL ]],
                ['label' => 'Квитанции', 'url' => ['/data-entrant/receipt-contract/index']],
            ]

        );
    }

    elseif($jobEntrant && $jobEntrant->isCategoryTarget()) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Абитуриенты ТД', 'url' => ['/data-entrant/default/index', 'is_id' => JobEntrantHelper::TASHKENT_BB]],
                ['label' => 'Абитуриенты ЦиС', 'url' => ['/data-entrant/default/index', 'is_id' => JobEntrantHelper::TARGET_BB]],
                ['label' => 'Целевые договоры', 'url' => ['/data-entrant/agreement/index']],
                ['label' => 'Заявки на экзамен РД', 'url' => ['/data-exam/exam-statement/violation']],
            ]

        );
    }

    elseif($jobEntrant && $jobEntrant->isCategoryExam()) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Экзамены', 'url' => ['/data-exam/exam/index']],
                ['label' => 'Группы вопросов', 'url' => ['/data-exam/exam-question-group/index']],
                ['label' => 'Вопросы', 'url' => ['/data-exam/exam-question/index']],
            ]

        );
    }


    elseif ($jobEntrant && in_array($jobEntrant->category_id, JobEntrantHelper::listCategoriesZUK()) && in_array($jobEntrant->category_id, JobEntrantHelper::listCategoriesZID())) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Заявления (ЗУК)',
                    "items" => [
                        [
                            "label" => 'Просмотр',
                            "url" => ['/data-entrant/statement/index'],
                            "icon" => "table",
                        ],
                        [
                            "label" => "Принятые ЗУК",
                            "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_ACCEPTED],
                            "icon" => "list",
                        ],
                        [
                            "label" => "Непринятые ЗУК",
                            "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_NO_ACCEPTED],
                            "icon" => "list-ul",
                        ],
                        [
                            "label" => "Взято в работу",
                            "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_VIEW],
                            "icon" => "list-ul",
                        ],
                        [
                            "label" => "Отозванные ЗУК",
                            "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_RECALL],
                            "icon" => "list-ol",
                        ]
                    ]],

                ['label' => 'Экспресс (Новые ЗУК)', 'url' => ['/data-entrant/statement/new']],
                ['label' => 'Заявления (ЗОС)', 'url' => ['/data-entrant/statement-consent-cg/index']],
                ['label' => 'Экспресс (Новые ЗОС)', 'url' => ['/data-entrant/statement-consent-cg/new']],
                [
                    "label" => "Ход подачи",
                    "url" => '/data-entrant/charts',
                    "icon" => "table",
                ],
                ['label' => 'Абитуриенты (ЗИД)', 'url' => ['/data-entrant/default/index']],

                $jobEntrant->isCategoryMPGU() ?
                    ['label' => 'Пот. абитуриенты', 'url' => ['/data-entrant/entrant-potential/index']]:
                    ['label' => 'Пот. абитуруенты', 'items'=> [
                        [
                            "label" => 'ЗУК',
                            'url' => ['/data-entrant/entrant-potential/index', 'is_id'=> JobEntrantHelper::ENTRANT_POTENTIAL_STATEMENT_DRAFT],
                            "icon" => "user-plus",
                        ],
                        [
                            "label" => 'без ЗУК',
                            'url' => ['/data-entrant/entrant-potential/index', 'is_id'=> JobEntrantHelper::ENTRANT_POTENTIAL_NO_STATEMENT],
                            "icon" => "user-plus",
                        ],
                    ]],
                ['label' => 'Заявления (ЗИД)', 'url' => ['/data-entrant/statement-individual-achievements/index']],
                $jobEntrant->isCategoryMPGU() ? [] : ['label' => 'Договоры', 'url' => ['/data-entrant/agreement-contract/index']],
                $jobEntrant->isCategoryMPGU() ? [] : ['label' => 'Квитанции', 'url' => ['/data-entrant/receipt-contract/index']],
                ]

        );
    }
    elseif ($jobEntrant && in_array($jobEntrant->category_id, JobEntrantHelper::listCategoriesZID())  && !in_array($jobEntrant->category_id, JobEntrantHelper::listCategoriesZUK())) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Абитуриенты', 'url' => ['/data-entrant/default/index']],
                ['label' => 'Заявления (ЗИД)', 'url' => ['/data-entrant/statement-individual-achievements/index'],
                 ]
            ]

        );
    }elseif ($jobEntrant && in_array($jobEntrant->category_id, JobEntrantHelper::listCategoriesZUK()) && !in_array($jobEntrant->category_id, JobEntrantHelper::listCategoriesZID())) {
        return array_merge(
            [
                ['label' => 'Профиль', 'url' => ['/profile/edit']],
                ['label' => 'Настройки', 'url' => ['/sign-up/user-edit']],
                ['label' => 'Абитуриенты', 'url' => ['/data-entrant/default/index']],
                $jobEntrant->isCategoryMPGU() ?
                    ['label' => 'Пот. абитуриенты', 'url' => ['/data-entrant/entrant-potential/index']]:

                    ['label' => 'Пот. абитуруенты', 'items'=> [
                    [
                        "label" => 'ЗУК',
                        'url' => ['/data-entrant/entrant-potential/index', 'is_id'=> JobEntrantHelper::ENTRANT_POTENTIAL_STATEMENT_DRAFT],
                        "icon" => "user-plus",
                    ],
                    [
                        "label" => 'без ЗУК',
                        'url' => ['/data-entrant/entrant-potential/index', 'is_id'=> JobEntrantHelper::ENTRANT_POTENTIAL_NO_STATEMENT],
                        "icon" => "user-plus",
                    ],

                ]],

                ['label' => 'Заявления (ЗУК)',
                "items" => [
            [
                "label" => 'Просмотр',
                "url" => ['/data-entrant/statement/index'],
                "icon" => "table",
            ],
            [
            "label" => "Принятые ЗУК",
                    "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_ACCEPTED],
                    "icon" => "list",
                ],
                    [
                        "label" => "Взято в работу",
                        "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_VIEW],
                        "icon" => "list-ul",
                    ],
                    [
                        "label" => "Непринятые ЗУК",
                        "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_NO_ACCEPTED],
                        "icon" => "list-ul",
                    ],
                    [
                        "label" => "Отозванные ЗУК",
                        "url" => ['/data-entrant/statement/index', 'status'=> StatementHelper::STATUS_RECALL],
                        "icon" => "list-ol",
                    ]
                    ]],

            ['label' => 'Экспресс (Новые ЗУК)', 'url' => ['/data-entrant/statement/new']],
                ['label' => 'Заявления (ЗОС)', 'url' => ['/data-entrant/statement-consent-cg/index']],
            ['label' => 'Экспресс (Новые ЗОС)', 'url' => ['/data-entrant/statement-consent-cg/new']],
                [
                    "label" => "Ход подачи",
                    "url" => '/data-entrant/charts',
                    "icon" => "table",
                ],]

        );
    } else {return [];}

}