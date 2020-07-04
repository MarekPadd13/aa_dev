<?php

namespace modules\entrant\migrations;
use \yii\db\Migration;

class m191208_000083_add_columns_statement_agreement extends Migration
{
    private function table() {
        return 'statement_agreement_contract_cg';
    }

    public function up()
    {
        $this->renameColumn($this->table(), 'is_mouth', 'is_month');
    }
}
