<?php

namespace modules\entrant\helpers;


use common\auth\forms\DeclinationFioForm;
use dictionary\helpers\DictCompetitiveGroupHelper;
use modules\dictionary\helpers\DictCseSubjectHelper;
use modules\dictionary\helpers\DictIncomingDocumentTypeHelper;
use modules\dictionary\models\DictCseSubject;
use modules\entrant\models\AdditionalInformation;
use modules\entrant\models\Address;
use modules\entrant\models\Agreement;
use modules\entrant\models\Anketa;
use modules\entrant\models\CseSubjectResult;
use modules\entrant\models\CseViSelect;
use modules\entrant\models\DocumentEducation;
use modules\entrant\models\FIOLatin;
use modules\entrant\models\Language;
use modules\entrant\models\OtherDocument;
use modules\entrant\models\PassportData;
use modules\entrant\models\Statement;
use modules\entrant\models\StatementCg;
use modules\entrant\models\StatementIa;
use modules\entrant\models\StatementIndividualAchievements;
use modules\entrant\models\UserAis;
use modules\entrant\models\UserIndividualAchievements;
use morphos\S;
use olympic\models\auth\Profiles;
use wapmorgan\yii2inflection\Inflector;
use function Matrix\identity;

/* @var $profile Profiles */
class DataExportHelper
{
    public static function dataIncoming($userId)
    {
        $profile = Profiles::findOne(['user_id' => $userId]);
        $info = AdditionalInformation::findOne(['user_id' => $profile->user_id]);
        $anketa = Anketa::findOne(['user_id' => $profile->user_id]);
        $fioLatin = FIOLatin::findOne(['user_id' => $profile->user_id]);
        $passport = PassportData::findOne(['user_id' => $profile->user_id, 'main_status' => true]);
        $other = OtherDocument::findOne(['user_id' => $profile->user_id, 'exemption_id' => true]);
        $addressActual = self::address(AddressHelper::TYPE_ACTUAL, $profile->user_id);
        $addressRegistration = self::address(AddressHelper::TYPE_REGISTRATION, $profile->user_id);
        $addressResidence = self::address(AddressHelper::TYPE_RESIDENCE, $profile->user_id);
        $receptionMethodId = in_array($anketa->category_id, CategoryStruct::UMSGroup()) ? 2 : 1;
        $result = [
            'incoming' => [
                'surname' => $profile->last_name,
                'name' => $profile->first_name,
                'patronymic' => $profile->patronymic,
                'sex_id' => $profile->gender,
                'birthplace' => mb_strtoupper($passport->place_of_birth, 'UTF-8'),
                'citizenship_id' => $anketa->citizenship_id,
                'compatriot_status' => $anketa->isPatriot() ? 1 : 0,
                'hostel_need_status' => $info->hostel_id ? $info->hostel_id : 0,
                'birthdate' => $passport->date_of_birth,
                'address_registration_country_id' => $addressRegistration ? $addressRegistration->country_id : "",
                'address_registration_postcode' => $addressRegistration ? $addressRegistration->postcode : "",
                'address_registration_region' => $addressRegistration ? $addressRegistration->region : "",
                'address_registration_district' => $addressRegistration ? $addressRegistration->district : "",
                'address_registration_city' => $addressRegistration ? $addressRegistration->city : "",
                'address_registration_village' => $addressRegistration ? $addressRegistration->village : "",
                'address_registration_street' => $addressRegistration ? $addressRegistration->street : "",
                'address_registration_house' => $addressRegistration ? $addressRegistration->house : "",
                'address_registration_housing' => $addressRegistration ? $addressRegistration->housing : "",
                'address_registration_building' => $addressRegistration ? $addressRegistration->building : "",
                'address_registration_flat' => $addressRegistration ? $addressRegistration->flat : "",
                'address_residence_postcode' => $addressResidence ? $addressResidence->postcode : "",
                'address_residence_region' => $addressResidence ? $addressResidence->region : "",
                'address_residence_district' => $addressResidence ? $addressResidence->district : "",
                'address_residence_city' => $addressResidence ? $addressResidence->city : "",
                'address_residence_village' => $addressResidence ? $addressResidence->village : "",
                'address_residence_street' => $addressResidence ? $addressResidence->street : "",
                'address_residence_house' => $addressResidence ? $addressResidence->house : "",
                'address_residence_housing' => $addressResidence ? $addressResidence->housing : "",
                'address_residence_building' => $addressResidence ? $addressResidence->building : "",
                'address_residence_flat' => $addressResidence ? $addressResidence->flat : "",
                'address_actual_country_id' => $addressActual ? $addressActual->country_id : $profile->country_id,
                'address_actual_postcode' => $addressActual ? $addressActual->postcode : "",
                'address_actual_region' => $addressActual ? $addressActual->region : "",
                'address_actual_district' => $addressActual ? $addressActual->district : "",
                'address_actual_city' => $addressActual ? $addressActual->city : "",
                'address_actual_village' => $addressActual ? $addressActual->village : "",
                'address_actual_street' => $addressActual ? $addressActual->street : "",
                'address_actual_house' => $addressActual ? $addressActual->house : "",
                'address_actual_housing' => $addressActual ? $addressActual->housing : "",
                'address_actual_building' => $addressActual ? $addressActual->building : "",
                'address_actual_flat' => $addressActual ? $addressActual->flat : "",
                'phone_mobile' => $profile->phone,
                'email' => $profile->user->email,
                'school_type_id' => $anketa->current_edu_level,
                'parallel_education_status' => 0,
                'advertising_source_id' => $info->resource_id,
                'overall_diploma_mark' => $info->mark_spo ?? null,
                'surname_genitive' => \Yii::$app->inflection->inflectName($profile->last_name, Inflector::GENITIVE, $profile->gender),
                'name_genitive' => \Yii::$app->inflection->inflectName($profile->first_name, Inflector::GENITIVE, $profile->gender),
                'patronymic_genitive' => \Yii::$app->inflection->inflectName($profile->patronymic, Inflector::GENITIVE, $profile->gender),
                'surname_lat' => $fioLatin ? $fioLatin->surname : "",
                'name_lat' => $fioLatin ? $fioLatin->name : "",
                'reception_method_id' => $receptionMethodId,
                'mpgu_training_status' => $info->mpgu_training_status_id,
                'chernobyl_status' => $info->chernobyl_status_id,
                'quota_k1_status' => $other ? ($other->exemption_id == 1 ? 1 : 0) : 0,
                'quota_k2_status' => $other ? ($other->exemption_id == 2 ? 1 : 0) : 0,
                'quota_k3_status' => $other ? ($other->exemption_id == 3 ? 1 : 0) : 0,
                'special_conditions_status' => $info->voz_id,
            ]
        ];
        return array_merge($result,
            self::dataLanguage($userId),
            self::dataDocumentAll($userId, $profile),
            self::dataCSE($userId),
            self::cse($userId)
        );
    }

    public static function dataIncomingStatement($userId, $statementId)
    {
        $incomingId = UserAis::findOne(['user_id' => $userId]);
        $result['applications'] = [];
        $anketa = Anketa::findOne(['user_id' => $userId]);
        /* @var  $currentApplication StatementCg */
        /* @var  $statement Statement */
        $statement = Statement::find()->user($userId)->statusNoDraft()->id($statementId)->one();
        $prRight = PreemptiveRightHelper::preemptiveRightMin($userId);
        $organization = Agreement::findOne(['user_id' => $userId]);
        $target_organization_id = $statement->isSpecialRightTarget() && $organization
        && $organization->organization->ais_id ? $organization->organization->ais_id : null;
        foreach ($statement->statementCg as $currentApplication) {
            $noCse = DictCompetitiveGroupHelper::groupByExamsNoCseId($statement->user_id,
                $statement->faculty_id, $statement->speciality_id, $currentApplication->cg->id, false);
            $composite = DictCompetitiveGroupHelper::groupByExamsCseFacultyEduLevelSpecializationCompositeDiscipline(
                $statement->user_id,
                $statement->faculty_id,
                $statement->speciality_id,
                $currentApplication->cg->id);
            $result['applications'][] = [
                'incoming_id' => $incomingId->incoming_id,
                'competitive_group_id' => $currentApplication->cg->ais_id,
                'vi_status' => $noCse ? 1 : 0,
                'composite_discipline_id' => $composite,
                'preemptive_right_status' => $prRight ? 1 : 0,
                'preemptive_right_level' => $prRight ? $prRight : 0,
                'benefit_BVI_status' => $anketa->isWithOitCompetition() ? 1 : 0,
                'application_code' => $statement->numberStatement,
                'cathedra_id' => $currentApplication->cathedra_id ?? null,
                'target_organization_id' => $target_organization_id,
                // 'current_status_id' => '',
            ];
        }
        return $result;
    }

    public static function dataRemoveStatement($userId, $statementId)
    {
        $incomingId = UserAis::findOne(['user_id' => $userId]);
        $result['remove'] = [];
        $statement = Statement::find()->user($userId)->statusNoDraft()->id($statementId)->one();
        foreach ($statement->statementCg as $currentApplication) {
            $result['remove'][] = [
                'incoming_id' => $incomingId->incoming_id,
                'competitive_group_id' => $currentApplication->cg->ais_id,
            ];
        }
        return $result;
    }

    public static function dataIncomingStatementIa($userId, $statementId)
    {
        $incomingId = UserAis::findOne(['user_id' => $userId]);
        /* @var $currentIa StatementIa */
        $currentIa = StatementIa::findOne($statementId);
        $result['individual_achievements'] = [];
        $result['individual_achievements'][] = [
            'incoming_id' => $incomingId->incoming_id,
            'individual_achievement_id' => $currentIa->individual_id,
            'sdo_id' => $currentIa->userIndividualAchievements->dictOtherDocument->id,
            'model_type' => 2,
            'document_type_id' => $currentIa->userIndividualAchievements->dictOtherDocument->type,
            'document_series' => $currentIa->userIndividualAchievements->dictOtherDocument->series,
            'document_number' => $currentIa->userIndividualAchievements->dictOtherDocument->number,
            'document_issue' => $currentIa->userIndividualAchievements->dictOtherDocument->date,
            'document_authority' => mb_strtoupper($currentIa->userIndividualAchievements->dictOtherDocument->authority, 'UTF-8'),
            'document_authority_code' => '',
            'document_authority_country_id' => "",
            'diploma_authority' => '',
            'diploma_specialty_id' => '',
            'diploma_end_year' => '',
            'surname' => '',
            'name' => '',
            'patronymic' => '',
            'amount' => 1,
            'main_status' => 0,
        ];
        return $result;
    }

    public static function dataCSE($userId)
    {
        $cse = CseViSelectHelper::dataInAIASCSE($userId);
        $n = 0;
        if ($cse) {
            $result['documentsCse'] = [];
            foreach ($cse as $key => $value) {
                $result['documentsCse'][$n] =
                    [
                        'year' => $key,
                        'type_id' => 1,
                    ];
                foreach ($cse[$key] as $data) {
                    $result['documentsCse'][$n]['subject'][] = [
                        'cse_subject_id' => $data['ex'] == DictCseSubjectHelper::LANGUAGE ? DictCseSubjectHelper::aisId($data['language']) : DictCseSubjectHelper::aisId($data['cse']),
                        'mark' => $data['mark'],
                    ];
                }
                $n++;
            }
            return $result;
        }

        return [];
    }

    public static function cse($userId)
    {
        $cse = CseSubjectResult::find()->andWhere(['user_id' => $userId])->all();
        if ($cse) {
            $result['documentsCse'] = [];
            foreach ($cse as $key => $value) {
                $result['documentsCse'][$key] =
                    [
                        'year' => $value->year,
                        'type_id' => 1,
                    ];
                foreach ($value->dateJsonDecode() as $item => $mark) {

                    $result['documentsCse'][$key]['subject'][] = [
                        'cse_subject_id' => DictCseSubjectHelper::aisId($item),
                        'mark' => $mark,
                    ];
                }
            }
            return $result;

        }
        return [];
    }

    public static function dataLanguage($userId)
    {
        $result['foreign_languages'] = [];
        foreach (Language::find()->where(['user_id' => $userId])->all() as $currentLanguage) {
            $result['foreign_languages'][] = [
                'language_id' => $currentLanguage->language_id,
            ];
        }
        return $result;
    }

    public static function dataDocumentAll($userId, Profiles $profile)
    {
        $userAnketa = Anketa::findOne(['user_id' => $userId]);
        $documentCountryId = "";
        $surname = "";
        $name = "";
        $patronymic = "";
        $result['documents'] = [];

        foreach (PassportData::find()->where(['user_id' => $userId])->all() as $currentDocument) {
            $result['documents'][] = [
                'sdo_id' => $currentDocument->id,
                'model_type' => 1,
                'document_type_id' => $currentDocument->type,
                'document_series' => $currentDocument->series,
                'document_number' => $currentDocument->number,
                'document_issue' => $currentDocument->date_of_issue,
                'document_authority' => mb_strtoupper($currentDocument->authority, 'UTF-8'),
                'document_authority_code' => $currentDocument->division_code,
                'document_authority_country_id' => $currentDocument->nationality,
                'diploma_authority' => '',
                'diploma_specialty_id' => '',
                'diploma_end_year' => '',
                'surname' => $profile->last_name,
                'name' => $profile->first_name,
                'patronymic' => $profile->patronymic,
                'amount' => 1,
                'main_status' => $currentDocument->main_status ?? 0,
            ];
        }

        foreach (OtherDocument::find()->where(['user_id' => $userId, 'type_note' => null])
                     ->andWhere(['not in', 'id', UserIndividualAchievements::find()->user($userId)->select('document_id')->column()])
                     ->all() as $currentDocument) {
            if (in_array($currentDocument->document_type_id,
                [DictIncomingDocumentTypeHelper::ID_BIRTH_DOCUMENT,
                    DictIncomingDocumentTypeHelper::ID_BIRTH_FOREIGNER_DOCUMENT])) {
                $documentCountryId = $userAnketa->citizenship_id;
                $surname = $profile->last_name;
                $name = $profile->first_name;
                $patronymic = $profile->patronymic;
            }
            $result['documents'][] = [
                'sdo_id' => $currentDocument->id,
                'model_type' => 2,
                'document_type_id' => $currentDocument->type,
                'document_series' => $currentDocument->series,
                'document_number' => $currentDocument->number,
                'document_issue' => $currentDocument->date,
                'document_authority' => mb_strtoupper($currentDocument->authority, 'UTF-8'),
                'document_authority_code' => '',
                'document_authority_country_id' => $documentCountryId,
                'diploma_authority' => '',
                'diploma_specialty_id' => '',
                'diploma_end_year' => '',
                'surname' => $surname,
                'name' => $name,
                'patronymic' => $patronymic,
                'amount' => $currentDocument->type == DictIncomingDocumentTypeHelper::ID_PHOTO ? $currentDocument->amount : 1,
                'main_status' => 0,
            ];
        }

        foreach (DocumentEducation::find()->where(['user_id' => $userId])->all() as $currentDocument) {
            $result['documents'][] = [
                'sdo_id' => $currentDocument->id,
                'model_type' => 3,
                'document_type_id' => $currentDocument->type,
                'document_series' => $currentDocument->series,
                'document_number' => $currentDocument->number,
                'document_issue' => $currentDocument->date,
                'document_authority' => "",
                'document_authority_code' => "",
                'document_authority_country_id' => $currentDocument->school->country_id,
                'diploma_authority' => $currentDocument->schoolName,
                'diploma_specialty_id' => '',
                'diploma_end_year' => $currentDocument->year,
                'patronymic' => $currentDocument->patronymic ?? $profile->patronymic,
                'surname' => $currentDocument->surname ?? $profile->last_name,
                'name' => $currentDocument->name ?? $profile->first_name,
                'amount' => 1,
                'main_status' => 1,
            ];
        }
        return $result;
    }

    private static function address($type, $user_id)
    {
        return Address::findOne(['user_id' => $user_id, 'type' => $type]);
    }

    public static function dataIncomingAgreement(Agreement $agreement)
    {
        /* @var  $currentApplication StatementCg */
        /* @var  $statement Statement */
        $result['organization'] = [];
        $result['organization'][] =
            [
                'name' => $agreement->organization->name,
                'code' => 'sdo' . $agreement->organization->id,
            ];
        foreach ($agreement->statement as $statement) {
            foreach ($statement->statementCg as $currentApplication) {
                $result['organization'][]['cg'][] = [
                    'competitive_group_id' => $currentApplication->cg->ais_id,
                ];
            }
        }
        return $result;
    }

}