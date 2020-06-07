<?php


namespace modules\entrant\helpers;


use dictionary\models\DictCompetitiveGroup;

class Settings
{
    /**
     * @var string
     * Окончание приема ЗУК в СПО бюджет Москва
     */
    public $ZukSpoOchMoscowBudget = '2020-08-25 00:00:00';
    /**
     * @var string
     * Окончание приема ЗУК в СПО бюджет филиалы
     */
    public $ZukSpoOchFilialBudget = '2020-08-25 00:00:00';
    /**
     * @var string
     * Окончание приема ЗУК в СПО договор Москва
     */
    public $ZukSpoOchMoscowContract = '2020-08-25 00:00:00';
    /**
     * @var string
     * Окончание приема ЗУК в СПО договор филиалы
     */
    public $ZukSpoOchFilialContract = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений (ЕГЭ) бакалавриата бюджетной основы
     */
    public $ZukBacOchBudgetCse = '2020-06-07 01:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений (ВИ) бакалавриата бюджетной основы
     */
    public $ZukBacOchBudgetVi = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений (ЕГЭ) бакалавриата бюджетной основы
     */
    public $ZukBacZaOchBudgetCse = '2020-06-05 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений (ВИ) бакалавриата бюджетной основы
     */
    public $ZukBacZaOchBudgetVi = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений (ЕГЭ) бакалавриата договорной основы Москва
     */
    public $ZukBacOchContractCseMoscow = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений (ВИ) бакалавриата договорной основы Москва
     */
    public $ZukBacOchContractViMoscow = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений (ЕГЭ) бакалавриата договорной основы Филиалы
     */
    public $ZukBacOchContractCseFilial = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений (ВИ) бакалавриата договорной основы Филиалы
     */
    public $ZukBacOchContractViFilial = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений (ЕГЭ) бакалавриата договорной основы, Москва
     */
    public $ZukBacZaOchContractMoscowCse = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений (ВИ) бакалавриата договорной основы, Москва
     */
    public $ZukBacZaOchContractMoscowVi = "2020-08-25 00:00:00";

    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений (ВИ) бакалавриата договорной основы, Филиалы
     */
    public $ZukBacZaOchContractFilialVi = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений магистратуры бюджет
     */
    public $ZukMagOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений магистратуры бюджет
     */
    public $ZukMagZaOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений магистратуры бюджет
     */
    public $ZukMagOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений магистратуры бюджет
     */
    public $ZukMagZaOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных заявлений аспирантуры бюджет
     */
    public $ZukAspOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных заявлений аспирантуры договор
     */
    public $ZukAspOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений аспирантуры договор
     */
    public $ZukAspZaOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Окончание приема документов по гослинии
     */
    public $ZukUmsGovline = "2020-06-06 00:00:00";
    /**
     * @var string
     * Окончание приема ЗОС в СПО бюджет Москва
     */
    public $ZosSpoOchMoscowBudget = '2020-08-25 00:00:00';
    /**
     * @var string
     * Окончание приема ЗОС в СПО бюджет Москва
     */
    public $ZosSpoOchFilialBudget = '2020-08-25 00:00:00';
    /**
     * @var string
     * Окончание приема ЗОС в СПО бюджет филиалы
     */
    public $ZosSpoOchMoscowContract = '2020-08-25 00:00:00';
    /**
     * @var string
     * Окончание приема ЗОС в СПО договор филиалы
     */
    public $ZosSpoOchFilialContract = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных
     * заявлений (ЕГЭ) бакалавриата бюджетной основы
     */
    public $ZosBacOchBudgetCse = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных
     * заявлений (ВИ) бакалавриата бюджетной основы
     */
    public $ZosBacOchBudgetVi = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений
     * (ЕГЭ) бакалавриата бюджетной основы, НЕ для филиалов
     */
    public $ZosBacZaOchBudgetMoscowCse = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений
     * (ВИ) бакалавриата бюджетной основы, НЕ для филиалов
     */
    public $ZosBacZaOchBudgetFilialVi = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных
     * заявлений (ЕГЭ) бакалавриата договорной основы
     */
    public $ZosBacOchContractCseMoscow = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений
     * (ВИ) бакалавриата договорной основы
     */
    public $ZosBacOchContractViMoscow = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений
     * (ЕГЭ) бакалавриата договорной основы филиалы
     */
    public $ZosBacOchContractCseFilial = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений
     * (ВИ) бакалавриата договорной основы филиалы
     */
    public $ZosBacOchContractViFilial = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений
     * (ЕГЭ) бакалавриата договорной основы, НЕ для филиалов
     */
    public $ZosBacZaOchContractMoscowCse = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений
     * (ВИ) бакалавриата договорной основы, НЕ для филиалов
     */
    public $ZosBacZaOchContractFilialVi = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных
     * заявлений магистратуры бюджет
     */
    public $ZosMagOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений магистратуры бюджет
     */
    public $ZosMagZaOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных заявлений аспирантуры бюджет
     */
    public $ZosAspOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных заявлений аспирантуры договор
     */
    public $ZosAspOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений аспирантуры договор
     */
    public $ZosAspZaOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных
     * ЗИД бакалавриата бюджетной основы
     */
    public $ZidBacOchBudget = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема заочных
     * ЗИД бакалавриата бюджетной основы
     */
    public $ZidBacZaOchBudget = '2020-08-25 00:00:00';
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений бакалавриата
     * бюджетной основы, НЕ для филиалов
     */
    public $ZidBacZaOchBudgetFilial = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных и очно-заочных заявлений магистратуры бюджет
     */
    public $ZidMagOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений магистратуры бюджет
     */
    public $ZidMagZaOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных заявлений аспирантуры бюджет
     */
    public $ZidAspOchBudget = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема очных заявлений аспирантуры договор
     */
    public $ZidAspOchContract = "2020-08-25 00:00:00";
    /**
     * @var string
     * Абитуриент - окончание приема заочных заявлений аспирантуры договор
     */
    public $ZidAspZaOchContract = "2020-08-25 00:00:00";
    /**
     * @var bool
     * Запрет экспорта
     */
    public $bansExport = false;
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Разрешено ли выбирать данную образовательную программу
     */
    public function allowedToSubmitByTheDeadline(DictCompetitiveGroup $cg)
    {
        return $this->allowCgCseContractMoscow($cg) &&
            $this->allowCgCseContractFilial($cg) &&
            $this->allowCgUmsGovLine($cg);
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Можно ли загружать с заявление бакалавриата с выбором ВИ на бюджет
     */
    public function allowStatementUploadViBudget(DictCompetitiveGroup $cg): bool
    {
        if ($this->contractCpk($cg)) {
            return true;
        }
        if ($cg->isOchCg() || $cg->isOchZaOchCg()) {
            return $this->allowBacViOchBudget();
        }
        return true;
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Разрешенно ли загружать договорные заявления по ВИ Москва
     */
    public function allowStatementUploadViContractMoscow(DictCompetitiveGroup $cg): bool
    {
        if (!$this->noBudgetCpk($cg)) {
            return true;
        }
        if ($this->ochOrOchZaOch($cg)) {
            return $this->allowBacViOchContractMoscow();
        }

        if ($cg->isZaOchCg()) {
            return $this->allowBacViZaOchContractMoscow();
        }
        return true;
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Проверка на разрешение выбора образовательных программ по ЕГЭ договор Москва
     */
    public function allowCgCseContractMoscow(DictCompetitiveGroup $cg): bool
    {
        if (!$this->isHeadUniversity()) {
            return true;
        }
        if ($cg->isBudget() || $cg->isUmsCg()) {
            return true;
        }
        if (($cg->isOchCg() || $cg->isOchZaOchCg())) {
            return $this->allowBacCseOchContactMoscow();
        }
        if ($cg->isZaOchCg()) {
            return $this->allowBacCseZaOchContractMoscow();
        }

        return true;
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Проверка разрешения выбора КГ в филиалы договор
     */
    public function allowCgCseContractFilial(DictCompetitiveGroup $cg): bool
    {
        if ($this->isHeadUniversity()) {
            return true;
        }
        if ($cg->isBudget() || $cg->isUmsCg()) {
            return true;
        }
        if (($cg->isOchCg() || $cg->isOchZaOchCg())) {
            return $this->allowBacCseOchContractFilial();
        }
        return true;
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Определяет сроки окончания приема заявлений УМС по гослинии
     */
    public function allowCgUmsGovLine(DictCompetitiveGroup $cg): bool
    {
        if ($cg->isGovLineCg()) {
            return strtotime($this->ZukUmsGovline) > $this->currentDate();
        }
        return true;
    }

    // Проверка кокнурсных групп для ЗУК
    public function allowCgForDeadLineBudget(DictCompetitiveGroup $cg): bool
    {
        if (($cg->isOchCg() || $cg->isOchZaOchCg()) && $cg->isBudget() && !$cg->isUmsCg()) {
            return strtotime($this->ZukBacOchBudgetCse) > $this->currentDate();
        }

        if ($cg->isZaOchCg() && $cg->isBudget() && !$cg->isUmsCg()) {
            return strtotime($this->ZukBacZaOchBudgetCse) > $this->currentDate();
        }

        if ($cg->isUmsCg() && $cg->isBudget()) {
            return strtotime($this->ZukUmsGovline) > $this->currentDate();
        }

        return true;
    }

    public function allowCgVi(DictCompetitiveGroup $cg)
    {
        return $this->allowCgViBudget($cg) && $this->allowCgViContractMoscow($cg) && $this->allowCgViContractFilial($cg);
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Проверка разрешения подачи документов на конкурсную группу по ВИ на бюджет
     */
    public function allowCgViBudget(DictCompetitiveGroup $cg): bool
    {
        if ($this->contractCpk($cg)) {
            return true;
        }
        if ($this->ochOrOchZaOch($cg)) {
            return $this->allowBacViOchBudget();
        }
        if ($cg->isZaOchCg()) {
            return $this->allowBacViZaOchBudget();
        }
        return true;
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Проверка разрешения подачи документов на конкурсную группу по ВИ на договор в Москве
     */
    public function allowCgViContractMoscow(DictCompetitiveGroup $cg): bool
    {
        if ($this->budgetCpk($cg)) {
            return true;
        }
        if ($this->ochOrOchZaOch($cg)) {
            return $this->allowBacViOchContractMoscow();
        }
        if ($cg->isZaOchCg()) {
            return $this->allowBacViZaOchContract();
        }
        return true;
    }
    /**
     * @param DictCompetitiveGroup $cg
     * @return bool
     * Разрешено ли подавать документы в бакалавриат на договорной основе в филиал
     */
    public function allowCgViContractFilial(DictCompetitiveGroup $cg): bool
    {
        if ($this->isHeadUniversity()) {
            return true;
        }
        if ($this->noBudgetCpk($cg)) {
            return true;
        }
        if ($this->ochOrOchZaOch($cg)) {
            return $this->allowBacViOchContractFilial();
        }
        if ($cg->isZaOchCg()) {
            return $this->allowBacViZaOchContractFilial();
        }
        return true;
    }
    // Проверка вышел ли срок приема ЗУК по внутренним вступительным испытаниям

    public function allowViOchBackBudget(): bool
    {
        return strtotime($this->ZukBacOchBudgetVi) > $this->currentDate();
    }

    public function allowBacCseOchBudget(): bool
    {
        return strtotime($this->ZukBacOchBudgetCse) > $this->currentDate();
    }

    public function allowBacCseOchContactMoscow(): bool
    {
        return strtotime($this->ZukBacOchContractCseMoscow) > $this->currentDate();
    }

    public function allowBacCseOchContractFilial(): bool
    {
        return strtotime($this->ZukBacOchContractCseFilial) > $this->currentDate();

    }

    public function allowBacViOchBudget(): bool
    {
        return strtotime($this->ZukBacOchBudgetVi) > $this->currentDate();
    }

    public function allowBacViZaOchBudget(): bool
    {
        return strtotime($this->ZukBacZaOchBudgetVi) > $this->currentDate();
    }

    /**
     * @param $depart - головной вуз или филиал данные из анкеты
     * @return bool
     */
    public function allowBacCseOchContractMoscow(): bool
    {
        return strtotime($this->ZukBacOchContractViMoscow) > $this->currentDate();
    }

    /**
     * @return bool
     * Разрешено ли подавать документы на договор на заочную форму по ЕГЭ
     */
    public function allowBacCseZaOchContractMoscow(): bool
    {
        return strtotime($this->ZukBacZaOchContractMoscowCse) > $this->currentDate();
    }

    /**
     * @param $depart - головной вуз или филиал данные из анкеты
     * @return bool
     */
    public function allowBacViOchContractMoscow(): bool
    {
        return strtotime($this->ZukBacOchContractViMoscow) > $this->currentDate();
    }

    /**
     * @return bool
     */
    public function allowBacViZaOchContractMoscow(): bool
    {
        return strtotime($this->ZukBac);
    }

    /**
     * @return bool
     * Разрешенно ли подавать документы по ВИ на очную форму Филиалы
     */
    public function allowBacViOchContractFilial()
    {
        return strtotime($this->ZukBacOchContractViFilial) > $this->currentDate();
    }

    /**
     * @return bool
     * Разрешено ли подавать документы на заочную форму по ВИ в Филиал
     */
    public function allowBacViZaOchContractFilial()
    {
        return strtotime($this->ZukBacZaOchContractFilialVi) > $this->currentDate();
    }

    private function currentDate()
    {
        //   \date_default_timezone_set('Europe/Moscow');
        return strtotime(\date("Y-m-d G:i:s"));
    }

    private function getAnketa()
    {
        if (!$anketa = \Yii::$app->user->identity->anketa()) {
            throw new \DomainException('Нет анкеты!');
        }
        return $anketa;
    }

    private function isHeadUniversity()
    {
        $anketa = $this->getAnketa();
        return $anketa->university_choice == AnketaHelper::HEAD_UNIVERSITY;
    }

    private function budgetCpk(DictCompetitiveGroup $cg)
    {
        return $cg->isBudget() && !$cg->isUmsCg();
    }

    private function contractCpk(DictCompetitiveGroup $cg)
    {
        return !$cg->isBudget() && !$cg->isUmsCg();
    }

    private function ochOrOchZaOch(DictCompetitiveGroup $cg)
    {
        return $cg->isOchCg() || $cg->isOchZaOchCg();
    }

}