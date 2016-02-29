<?php

use yii\db\Migration;

class m160229_094719_add_txid_to_deposits extends Migration
{
    public function up()
    {
        $this->addColumn('cryptocoin_deposits', 'txid', 'varchar(100) AFTER `expire_date` ');
    }

    public function down()
    {
        $this->dropColumn('cryptocoin_deposits', 'txid');
    }
}
