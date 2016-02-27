<?php

use yii\db\Migration;

class m160227_122440_add_user_id_in_deposits extends Migration
{
    public function up()
    {
        $this->addColumn('cryptocoin_deposits', 'user_id', 'integer AFTER `id` ');
    }

    public function down()
    {
        $this->dropColumn('cryptocoin_deposits', 'user_id');
    }
}
