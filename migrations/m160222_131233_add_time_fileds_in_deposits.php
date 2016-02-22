<?php

use yii\db\Migration;

class m160222_131233_add_time_fileds_in_deposits extends Migration
{
    public function up()
    {
        $this->addColumn('cryptocoin_deposits', 'expire_date', 'integer AFTER `pay_amount` ');
    }

    public function down()
    {
        $this->dropColumn('cryptocoin_deposits', 'expire_date');
    }
}
