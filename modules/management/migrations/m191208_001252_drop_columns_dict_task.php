<?php
namespace modules\management\migrations;

use modules\management\models\DictTask;
use \yii\db\Migration;

class m191208_001252_drop_columns_dict_task extends Migration
{
    private function table() {
        return DictTask::tableName();
    }

    public function up()
    {
        $this->dropColumn($this->table(), 'template_file');
    }
}
