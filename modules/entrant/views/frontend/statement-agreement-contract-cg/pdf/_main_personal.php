<?php
/* @var $personal yii\web\View */

use common\auth\helpers\DeclinationFioHelper;
use dictionary\helpers\DictCompetitiveGroupHelper;
use modules\entrant\helpers\AddressHelper;
use modules\entrant\helpers\AgreementHelper;
use modules\entrant\helpers\DateFormatHelper;
use modules\entrant\helpers\PassportDataHelper;
use olympic\helpers\auth\ProfileHelper;
use yii\helpers\Html;

/* @var $agreement modules\entrant\models\StatementAgreementContractCg */

/* @var $personal modules\entrant\models\PersonalEntity */

$profile = ProfileHelper::dataArray($agreement->statementCg->statement->user_id);
$passport = PassportDataHelper::dataArray($agreement->statementCg->statement->user_id);
$personal = $agreement->personal;
$personal->series;
$personal->number;
$personal->division_code;
$personal->phone;
$personal->date_of_issue;
$personal->authority;
$name = DeclinationFioHelper::userDeclination($agreement->statementCg->statement->user_id);
$cg = $agreement->statementCg->cg;
$agreementData = AgreementHelper::data($anketa->university_choice);
$reg = AddressHelper::registrationResidence($agreement->statementCg->statement->user_id);
$totalCost = $cg->education_year_cost * ceil($cg->education_duration);
$costExplode = explode(".", $totalCost);
$costRuble = $costExplode[0];
$costMonet = $costExplode[1] ?? "00";
$costPerYearExplode = explode(".", $cg->education_year_cost);
$costRublePerYear = $costPerYearExplode[0];
$costMonetPerYear = $costPerYearExplode[1] ?? "00";
$educationMonth = "";
$number = $agreement->number;
$educationDuration = floor($cg->education_duration);
$eduDurationMonth = $cg->education_duration - $educationDuration;
if ($eduDurationMonth >= 1 / 12) {
    $educationMonth = ' ' . ceil(12 * $eduDurationMonth) . ' мес.';
}

?>
<div width="100%" class="fs-11 agreement">
    <table width="100%" class="fs-11">
        <tr>
            <td><?= Html::img(\Yii::$app->params["staticPath"] . "/img/incoming/logo.svg") ?></td>
            <td class="text-center"><strong>ДОГОВОР №<?=$number?></strong><br/>
                об оказании платных образовательных услуг
            </td>
        </tr>
        <tr>
            <td class="h-30">г. Москва</td>
            <td class="text-right"><?= Yii::$app->formatter->asDate($agreement->created_at) ?></td>
        </tr>
    </table>
    <p align="justify">
        Федеральное государственное бюджетное образовательное учреждение высшего образования
        «Московский педагогический государственный университет» (сокращенное наименование - МПГУ),
        на основании лицензии на осуществление образовательной деятельности от 11 декабря 2015 г. № 1818,
        выданной Федеральной службой по надзору в сфере образования и науки на срок – бессрочно, и
        свидетельства о государственной аккредитации от 15 апреля 2016 г. № 1857, выданного Федеральной
        службой по надзору в сфере образования и науки на срок до 17 февраля 2021 г., именуемое в дальнейшем
        «Исполнитель», а также «Университет», в лице <?= $agreementData['positionsGenitive'] ?>
        <?= $agreementData['directorNameGenitiveFull'] ?>,
        действующего на основании доверенности <?= $agreementData['procuration'] ?>,<br/><br/>
        и <strong><?= $personal->fio ?></strong> именуемый(ая) в дальнейшем «Заказчик»,<br/>
        и <strong><?= $profile['last_name'] ?> <?= $profile['first_name'] ?>
            <?= $profile['patronymic'] ? " " . $profile['patronymic'] : "" ?>
        </strong> именуемый(ая), в дальнейшем «Обучающийся»,<br/>
        совместно именуемые Стороны, заключили настоящий Договор (далее - Договор), о нижеследующем:
    </p>
    <p class="text-center"><strong>1. Предмет договора</strong></p>

    <p align="justify">1.1. Исполнитель обязуется предоставить образовательную услугу,
        а Заказчик обязуется оплатить обучение по основной профессиональной образовательной программе
        <?php if ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_SPO): ?>
            среднего профессионального образования –  программе подготовки специалистов среднего звена,
        <?php else: ?>
            высшего образования -
            <?php if ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_BACHELOR): ?>
                программе бакалавриата,
            <?php elseif ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_MAGISTER): ?>
                программе магистратуры,
            <?php elseif ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_GRADUATE_SCHOOL): ?>
                программе подготовки научно-педагогических кадров в аспирантуре,
            <?php endif; ?>
        <?php endif; ?>
        направления подготовки <strong><?= $cg->specialty->getCodeWithName() ?></strong>,
        направленность (профиль) <strong><?= $cg->specialization->name ?? $cg->specialty->name?></strong>
        (далее – образовательная программа) в пределах федерального государственного образовательного
        стандарта в соответствии с учебным планом, в том числе индивидуальным, и образовательной
        программой Исполнителя.
    </p>
    <p align="justify">
        Форма обучения -
        <strong><?= DictCompetitiveGroupHelper::formName($cg->education_form_id) ?>.</strong>
    </p>
    <p align="justify">
        1.2. Срок освоения образовательной программы (продолжительность обучения) на момент
        подписания Договора составляет <strong><?= $educationDuration ?></strong> год(а) (лет)
        <strong><?= $educationMonth ?></strong>
        (<strong><?= round($cg->education_duration * 2) ?></strong> учебных семестров).
    </p>
    <p align="justify">
        1.3. После освоения Обучающимся образовательной программы, имеющей государственную
        аккредитацию, и успешного прохождения государственной итоговой аттестации ему выдается документ
        об образовании и о квалификации, относящийся к соответствующему уровню профессионального
        образования
        (<?php if ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_SPO): ?>среднее профессиональное
            образование
        <?php else: ?>высшее образование -
            <?= DictCompetitiveGroupHelper::eduLevelForAgreement()[$cg->edu_level] ?><?php endif; ?>),
        - <?= DictCompetitiveGroupHelper::diplomaForEducationLevel()[$cg->edu_level] ?>,
        образец которого устанавливается федеральным органом исполнительной власти, осуществляющим
        функции по выработке и реализации государственной политики и нормативно-правовому регулированию
        в сфере
        <?php if ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_SPO): ?>
            общего образования.
        <?php else: ?>
            высшего образования.
        <?php endif; ?>
    </p>
    <p align="justify">
        После освоения Обучающимся образовательной программы, не имеющей государственной
        аккредитации, и успешного прохождения итоговой аттестации ему выдается документ об образовании и о
        квалификации, относящийся к соответствующему уровню профессионального образования (<?php if
        ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_SPO): ?>среднее профессиональное
            образование
        <?php else: ?>высшее образование
        - <?= DictCompetitiveGroupHelper::eduLevelForAgreement()[$cg->edu_level] ?>
        <?php endif; ?>),
        - <?= DictCompetitiveGroupHelper::diplomaForEducationLevel()[$cg->edu_level] ?>,
        образец которого самостоятельно устанавливается Исполнителем.
    </p>
    <p align="justify">
        Обучающемуся, не прошедшему итоговую аттестацию/государственную итоговую аттестацию или
        получившему на итоговой аттестации/государственной итоговой аттестации неудовлетворительные
        результаты, а также Обучающемуся, освоившему часть образовательной программы и (или)
        отчисленному из Университета, выдается справка об обучении или о периоде обучения по образцу,
        самостоятельно устанавливаемому Исполнителем.
    </p>
    <p class="text-center"><strong>2. Взаимодействие Сторон</strong></p>

    <p align="justify">2.1. Исполнитель вправе:</p>
    <p align="justify">2.1.1. Самостоятельно осуществлять образовательный процесс, устанавливать системы оценок,
        формы, порядок и периодичность промежуточной аттестации Обучающегося;</p>
    <p align="justify">2.1.2. Применять к Обучающемуся меры поощрения и меры дисциплинарного взыскания в
        соответствии с законодательством Российской Федераций, учредительными документами Исполнителя,
        настоящим Договором и локальными нормативными актами Исполнителя, отчислять Обучающегося по
        основаниям, предусмотренным законодательством Российской Федерации;</p>
    <p align="justify">2.1.3. Предоставить отсрочку и (или) рассрочку по оплате обучения в соответствии с
        локальными
        нормативными актами Исполнителя.</p>
    <p align="justify">2.2. Заказчик вправе получать информацию от Исполнителя по вопросам организации и
        обеспечения надлежащего предоставления услуг, предусмотренных разделом 1 настоящего Договора.</p>
    <p align="justify">2.3. Обучающемуся предоставляются академические права в соответствии с частью 1 статьи 34
        Федерального закона от 29 декабря 2012 г. № 273-ФЗ «Об образовании в Российской Федерации».
        Обучающийся также вправе:</p>
    <p align="justify">2.3.1. Получать информацию от Исполнителя по вопросам организации и обеспечения
        надлежащего
        предоставления услуг, предусмотренных разделом 1 настоящего Договора;</p>
    <p align="justify">2.3.2. Пользоваться в порядке, установленном локальными нормативными актами Исполнителя,
        имуществом Исполнителя, необходимым для освоения образовательной программы;</p>
    <p align="justify">
        2.4.1. Зачислить Обучающегося, выполнившего установленные законодательством Российской
        Федерации, учредительными документами, локальными нормативными актами Исполнителя условия
        приема, в качестве <?php
        if ($cg->edu_level == DictCompetitiveGroupHelper::EDUCATION_LEVEL_GRADUATE_SCHOOL):?>
            аспиранта
        <?php else: ?>
            студента
        <?php endif; ?>
        на 1 курс, 1 семестр.
    </p>
    <p align="justify">2.4.2. Довести до Заказчика информацию, содержащую сведения о предоставлении платных
        образовательных услуг в порядке и объеме, которые предусмотрены Законом Российской Федерации от 7
        февраля 1992 г. № 2300-1 «О защите прав потребителей» и Федеральным законом от 29 декабря 2012 г. №
        273-ФЗ «Об образовании в Российской Федерации»;</p>
    <p align="justify">2.4.3. Организовать и обеспечить надлежащее предоставление образовательных услуг,
        предусмотренных разделом 1 настоящего Договора. Образовательные услуги оказываются в соответствии
        с федеральным государственным образовательным стандартом, учебным планом, в том числе
        индивидуальным, и расписанием занятий Исполнителя;</p>
    <p align="justify">2.4.4. Обеспечить Обучающемуся предусмотренные выбранной образовательной программой
        условия ее освоения;</p>
    <p align="justify">2.4.5. Принимать от Обучающегося и (или) Заказчика плату за образовательные услуги в
        размере и
        порядке, определенными настоящим Договором;</p>
    <p align="justify">2.4.6. Обеспечить Обучающемуся уважение человеческого достоинства, защиту от всех форм
        физического и психического насилия, оскорбления личности, охрану жизни и здоровья.</p>
    <p align="justify">2.5. Заказчик и (или) Обучающийся обязан(-ы) своевременно вносить плату за
        предоставляемые
        Обучающемуся образовательные услуги, указанные в разделе 1 настоящего Договора, в размере и
        порядке, определенными настоящим Договором, а также предоставлять платежные документы,
        подтверждающие такую оплату в порядке, предусмотренном разделом 3 настоящего Договора.</p>
    <p align="justify">2.6. Обучающийся исполняет обязанности, предусмотренные частями 1 и 2 статьи 43
        Федерального
        закона от 29 декабря 2012 г. № 273-ФЗ «Об образовании в Российской Федерации».</p>
    <p align="justify">2.7. Заказчик обязуется:</p>
    <p align="justify">2.7.1. Обеспечить добросовестное освоение Обучающимся образовательной программы и
        выполнение учебного плана.</p>
    <p align="justify">2.7.2. При поступлении Обучающегося в Университет и в процессе его обучения своевременно
        предоставлять все необходимые документы.</p>
    <p align="justify">2.7.3. Осуществлять контроль за обучением и выполнением Обучающимся учебного плана.</p>
    <p align="justify">2.7.4. Проявлять уважение к работникам Университета и другим обучающимся.</p>
    <p align="justify">2.7.5. Нести солидарную ответственность за ущерб, причиненный Обучающимся имуществу
        Университета (в том числе находящемуся в пользовании Университета), в соответствии с
        законодательством Российской Федерации.</p>
    <p align="justify">2.7.6. Своевременно извещать Университет об изменениях фамилии, имени, отчества, адреса,
        телефона, паспортных, анкетных и других данных.</p>
    <p class="text-center"><strong>3. Стоимость образовательных услуг, сроки и порядок их оплаты</strong></p>
    <p align="justify">3.1. Полная стоимость образовательных услуг за весь период обучения Обучающегося
        составляет
        <?= $costRuble
        . " (" . \Yii::$app->inflection->cardinalize($totalCost) . ") " ?>рублей(-я) <?= $costMonet ?>
        копеек(-йки),
        НДС не облагается на основании подпункта 14 пункта 2 статьи 149 Налогового кодекса Российской Федерации.
    </p>
    <p align="justify">Стоимость образовательных услуг за один учебный год составляет <?= $costRublePerYear ?>
        (<?= \Yii::$app->inflection->cardinalize($costRublePerYear) ?>) рублей(-я) <?= $costMonetPerYear ?>
        копеек(-йки),
        НДС не облагается на основании подпункта 14 пункта 2 статьи 149 Налогового кодекса Российской Федерации.
    </p>
    <p align="justify">
        Увеличение стоимости образовательных услуг после заключения настоящего Договора не
        допускается, за исключением увеличения стоимости указанных услуг с учетом уровня инфляции,
        предусмотренного основными характеристиками федерального бюджета на очередной финансовый год и
        плановый период.
    </p>
    <p align="justify">
        3.2. Оплата образовательных услуг производится по семестрам в следующем порядке:<br/>
        1) за 1-ый год обучения:<br/>
        - первый семестр - не позднее <?=AgreementHelper::payPerDate($cg->edu_level, $cg->education_form_id, $anketa->university_choice)?> текущего года;<br/>
        - второй семестр - не позднее 01 февраля текущего учебного года;<br/>
        2) за 2-ой и последующие годы обучения:<br/>
        - нечетный семестр - не позднее 01 сентября текущего учебного года;<br/>
        - четный семестр - не позднее 01 февраля текущего учебного года.
    </p>
    <p align="justify">
        3.3. Оплата производится за наличный расчет и/или в безналичном порядке на счет Университета,
        указанный в разделе 8 настоящего Договора. Размер оплаты за один семестр считается равным половине
        стоимости обучения за один учебный год.
    </p>
    <p align="justify">3.4. Копия платежного документа об оплате образовательных услуг за первый семестр для
        оформления приказа о зачислении предъявляется Заказчиком или Обучающимся в Приемную комиссию.
        Копии платежных документов об оплате образовательных услуг за второй и последующие семестры
        передаются в <strong><?= $cg->faculty->full_name ?></strong>.
    </p>
    <p align="justify">
        3.5. В случае изменения стоимости образовательных услуг (обучения) с учетом уровня инфляции
        Университет уведомляет Заказчика/Обучающегося об изменении стоимости обучения путем размещения
        информации в месте оказания образовательных услуг, по адресу места нахождения Университета, а также
        на официальном сайте Университета (mpgu.su) в информационно-телекоммуникационной сети
        «Интернет» не менее чем за 1 (один) месяц до даты изменения стоимости образовательных услуг. В этом
        случае Стороны обязаны заключить дополнительное соглашение об увеличении стоимости
        образовательных услуг.</p>
    <p align="justify">
        3.6. Оказание образовательных услуг по Договору не сопровождается подписанием актов приемки
        услуг Сторонами.</p>
    <p align="justify">
        3.7. В случае, если оплата обучения осуществляется за счет средств образовательного кредита,
        Обучающийся и (или) Заказчик обязаны проинформировать об этом Исполнителя в течение 10 (десяти)
        календарных дней после заключения Договора на оформление образовательного кредита.
    </p>
    <p align="justify">
        3.8. Во время нахождения в академическом отпуске оплата не взимается, а после возвращения из
        отпуска оплата производится в соответствии с разделом 3 настоящего Договора.
    </p>
    <p class="text-center"><strong>4. Порядок изменения и расторжения Договора</strong></p>
    <p align="justify">4.1. Условия, на которых заключен настоящий Договор, могут быть изменены по соглашению
        Сторон или в соответствии с законодательством Российской Федерации.
    </p>
    <p align="justify">4.2. Настоящий Договор может быть расторгнут по соглашению Сторон.</p>
    <p align="justify">4.3. Настоящий Договор может быть расторгнут по инициативе Исполнителя в одностороннем
        порядке в случаях, предусмотренных пунктом 21 Правил оказания платных образовательных услуг,
        утвержденных постановлением Правительства Российской Федерации от 15 августа 2013 г. № 706
        (Собрание законодательства Российской Федерации, 2013, № 34, ст. 4437).</p>
    <p align="justify">4.4. Действие настоящего Договора прекращается досрочно:<br/>
        - по инициативе Обучающегося или родителей (законных представителей) несовершеннолетнего
        Обучающегося, в том числе в случае перевода Обучающегося для продолжения освоения
        образовательной программы в другую организацию, осуществляющую образовательную деятельность;<br/>
        - по инициативе Исполнителя в случае применения к Обучающемуся, достигшему возраста
        пятнадцати лет, отчисления как меры дисциплинарного взыскания, в случае невыполнения Обучающимся
        по профессиональной образовательной программе обязанностей по добросовестному освоению такой
        образовательной программы и выполнению учебного плана, а также в случае установления нарушения
        порядка приема в образовательную организацию, повлекшего по вине Обучающегося его незаконное
        зачисление в образовательную организацию;<br/>
        - по обстоятельствам, не зависящим от воли Обучающегося или родителей (законных
        представителей) несовершеннолетнего Обучающегося и Исполнителя, в том числе в случае ликвидации
        Исполнителя.
    </p>
    <p align="justify">4.5. Исполнитель вправе отказаться от исполнения обязательств по Договору при условии
        полного
        возмещения Обучающемуся/Заказчику убытков.</p>
    <p class="fs-7">(ненужное вычеркнуть)</p>
    <p align="justify">4.6. Обучающийся/Заказчик вправе отказаться от исполнения настоящего Договора при условии
        оплаты
        Исполнителю</p>
    <p class="fs-7" style="text-indent: 60px">(ненужное вычеркнуть)</p>
    <div>фактически понесенных им расходов.</div>
    <p class="text-center"><strong>5. Ответственность Исполнителя, Заказчика и Обучающегося</strong></p>
    ответственность, предусмотренную законодательством Российской Федерации и настоящим
    Договором.
    <p align="justify">
        5.2. При обнаружении недостатка образовательной услуги, в том числе оказания не в полном
        объеме, предусмотренном образовательными программами (частью образовательной программы),
        Заказчик вправе по своему выбору потребовать:
    </p>
    <p align="justify">
        5.2.1. Безвозмездного оказания образовательной услуги;
    </p>
    <p align="justify">
        5.2.2. Соразмерного уменьшения стоимости оказанной образовательной услуги;
    </p>
    <p align="justify">
        5.2.3. Возмещения понесенных им расходов по устранению недостатков оказанной образовательной
        услуги своими силами или третьими лицами.
    </p>
    <p align="justify">
        5.3. Заказчик вправе отказаться от исполнения Договора и потребовать полного возмещения
        убытков, если в течение двух месяцев со дня предъявления Заказчиком требования об устранении
        недостатков недостатки образовательной услуги не устранены Исполнителем. Заказчик также вправе
        отказаться от исполнения Договора, если им обнаружен существенный недостаток оказанной
        образовательной услуги или иные существенные отступления от условий Договора.
    </p>
    <p align="justify">
        5.4. Если Исполнитель нарушил сроки оказания образовательной услуги (сроки начала и (или)
        окончания оказания образовательной услуги и (или) промежуточные сроки оказания образовательной
        услуги) либо если во время оказания образовательной услуги стало очевидным, что она не будет оказана в
        срок, Заказчик вправе по своему выбору:
    </p>
    <p align="justify">
        5.4.1. Назначить Исполнителю новый срок, в течение которого Исполнитель должен приступить к
        оказанию образовательной услуги и (или) закончить оказание образовательной услуги;
    </p>
    <p align="justify">
        5.4.2. Поручить оказать образовательную услугу третьим лицам за разумную цену и потребовать от
        Исполнителя возмещения понесенных расходов;
    </p>
    <p align="justify">
        5.4.3. Потребовать уменьшения стоимости образовательной услуги;
    </p>
    <p align="justify">
        5.4.4. Расторгнуть Договор.
    </p>
    <p class="text-center"><strong>6. Срок действия Договора</strong></p>
    <p align="justify">6.1. Настоящий Договор вступает в силу со дня его заключения Сторонами и действует до
        полного
        исполнения Сторонами обязательств.</p>
    <p class="text-center"><strong>7. Заключительные положения</strong></p>
    <p align="justify"> 7.1. Исполнитель вправе снизить стоимость платной образовательной услуги по Договору
        Обучающемуся, достигшему успехов в учебе и (или) научной деятельности, а также нуждающемуся в
        социальной помощи. Основания и порядок снижения стоимости платной образовательной услуги
        устанавливаются локальным нормативным актом Исполнителя и доводятся до сведения Обучающегося.
    </p>
    <p align="justify">
        7.2. Сведения, указанные в настоящем Договоре, соответствуют информации, размещенной на
        официальном сайте Исполнителя в информационно-телекоммуникационной сети «Интернет» на дату
        заключения настоящего Договора.
    </p>
    <p align="justify">
        7.3. Под периодом предоставления образовательной услуги (периодом обучения) понимается
        промежуток времени с даты издания приказа о зачислении Обучающегося в Университет до даты издания
        приказа об окончании обучения или отчислении Обучающегося из Университета.
    </p>
    <p align="justify">
        7.4. По вопросам, не предусмотренным настоящим Договором, Стороны руководствуются
        Федеральным законом от 29 декабря 2012 г. № 273-ФЗ «Об образовании в Российской Федерации» и
        иными нормативными правовыми актами, регулирующими отношения в сфере образования, другим
        действующим законодательством Российской Федерации.
    </p>
    <p align="justify">
        7.5. Все споры, возникающие между Сторонами, разрешаются в установленном законодательством
        Российской Федерации порядке.
    </p>
    <p align="justify">
        7.6. Во всех отношениях с третьими лицами Стороны выступают от своего имени. Ни одна из
        Сторон ни в каких случаях не несет ответственности по обязательствам другой стороны перед третьими
        лицами.
    </p>
    <p align="justify">
        7.7. О любых изменениях, данных (адреса, реквизитов, в том числе, изменениях фамилии,
        паспортных данных, банковских реквизитов) Обучающийся и Заказчик обязаны уведомить Исполнителя в
        течение 5 (пяти) календарных дней со дня соответствующего изменения в письменной форме (по почте
        заказным письмом с уведомлением либо доставляются представителю Исполнителя лично под расписку
        (при этом на втором экземпляре уведомления должна быть отметка о получении).
    </p>
    <p align="justify">
        7.8. Изменения и дополнения настоящего Договора могут производиться только в письменной
        форме путем оформления дополнительного соглашения к Договору и подписываться уполномоченными
        представителями Сторон.
    </p>
    <p align="justify">
        7.9. Настоящий Договор составлен в трех экземплярах, имеющих одинаковую юридическую силу:
        один – для Университета, один - для Заказчика, один – для Обучающегося.
    </p>
    <p class="text-center"><strong>8. Адреса и реквизиты Сторон</strong></p>
    <table width="100%" class="fs-11" cellspacing="0">
        <tr>
            <td class="text-center" width="35%"><strong>Университет</strong></td>
            <td class="text-center" width="20%"
                colspan="2"><strong>Обучающийся</strong></td>
            <td class="text-center" width="20%" colspan="2"><strong>Заказчик</strong></td>
        </tr>
        <tr>
            <td rowspan="6" class="br" align="left">
                <?= $agreementData['accidence'] ?>
            </td>
            <td class="bb h-30 pl-10" align="left" width="15%">Ф.И.О</td>
            <td class="bb br"
                align="left"><?= $profile['last_name'] . " " . $profile['first_name'] . " " . $profile['patronymic'] ?></td>

            <td class="bb h-30 pl-10" align="left" width="15%">Ф.И.О</td>
            <td class="bb"
                align="left"><?= $personal->fio ?></td>
        </tr>
        <tr>
            <td class="bb h-30 pl-10" align="left">паспорт:</td>
            <td class="bb br" align="left"><?= $passport['series'] . $passport['number'] ?></td>
            <td class="bb h-30 pl-10" align="left">паспорт:</td>
            <td class="bb" align="left"><?= $personal->series . $personal->number ?></td>
        </tr>
        <tr>
            <td class="bb h-30 pl-10" align="left">выдан:</td>
            <td class="bb br" align="left"><?= $passport['authority'] ?>
                <?=\date("d.m.Y", strtotime($passport['date_of_issue']))?></td>

            <td class="bb h-30 pl-10" align="left">выдан:</td>
            <td class="bb" align="left"><?= $personal->authority ?>
                <?=\date("d.m.Y", strtotime($personal->date_of_issue))?></td>
        </tr>
        <tr>
            <td class="bb h-30 pl-10" align="left">адрес регистрации:</td>
            <td class="bb br" align="left"><?= $reg['full'] ?></td>

            <td class="bb h-30 pl-10" align="left">адрес регистрации:</td>
            <td class="bb" align="left"><?= $personal->address ?></td>
        </tr>
        <tr>
            <td class="bb h-50 pl-10" align="left">телефон:</td>
            <td class="bb br" align="left"><?= $profile['phone'] ?></td>

            <td class="bb h-50 pl-10" align="left">телефон:</td>
            <td class="bb" align="left"><?= $personal->phone ?></td>
        </tr>
        <tr>
            <td rowspan="3" class="bb h-30 v-align-top pl-10" align="left"></td>
            <td rowspan="3" class="bb br v-align-top" align="left"></td>

            <td rowspan="3" class="bb h-30 v-align-top pl-10" align="left"></td>
            <td rowspan="3" class="bb v-align-top" align="left"></td>
        </tr>
        <tr>
            <td class="text-left h-50 br"><strong><?= $agreementData['positionNominative'] ?></strong></td>
        </tr>
        <tr>
            <td class="text-right br prb-20 bb"><strong><?= $agreementData['directorNameShort'] ?></strong></td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td class="text-left pl-20">Подпись<br/>м.п.</td>
                        <td class="text-right pr-20">Ф.И.О.</td>
                    </tr>
                </table>
            </td>
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td class="text-left pl-20">Подпись</td>
                        <td class="text-right pr-20">Ф.И.О.</td>
                    </tr>
                </table>
            </td>

            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td class="text-left pl-20">Подпись</td>
                        <td class="text-right pr-20">Ф.И.О.</td>
                    </tr>
                </table>
            </td>
    </table>

    <p align="justify">
        С условиями настоящего Договора, Уставом МПГУ, Лицензией, Свидетельством о государственной аккредитации,
        Правилами внутреннего распорядка Университета, Положением об оказании платных образовательных услуг
        МПГУ, утвержденным приказом МПГУ, ознакомлен(а)<br/><br/>
        «____» _____________ 20___ г. ________________ (подпись Поступающего)<br/><br/>
        «____» _____________ 20___ г. ________________ (подпись Заказчика)
    </p>
</div>