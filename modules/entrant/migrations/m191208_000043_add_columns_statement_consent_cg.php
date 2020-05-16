<?php
namespace modules\entrant\migrations;
use dictionary\models\DictSpeciality;
use dictionary\models\Faculty;
use modules\entrant\models\StatementCg;
use \yii\db\Migration;

class m191208_000043_add_columns_statement_consent_cg extends Migration
{
    private function table() {
        return \modules\entrant\models\StatementConsentCg::tableName();
    }

    public function up()
    {
        $this->addColumn($this->table(), 'count_pages', $this->integer()->defaultValue(0)->comment("количество страниц"));

    }

    public function down()
    {
        $this->dropColumn($this->table(), 'count_pages');
    }
}
