<?php

use yii\db\Migration;

class m160229_145240_add_ref_id_to_users_table extends Migration
{
    public function up()
    {
        $this->addColumn('cryptocoin_users', 'ref_id', 'integer AFTER `user_id` ');
    }

    public function down()
    {
        $this->dropColumn('cryptocoin_users', 'ref_id');
    }
}
