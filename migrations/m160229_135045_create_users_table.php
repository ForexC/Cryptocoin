<?php

use yii\db\Migration;

class m160229_135045_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('cryptocoin_users', [
            'id' => $this->primaryKey(),
            'created_date' => $this->integer(),
            'updated_date' => $this->integer(),
            'user_id' => $this->integer(),
            'address' => $this->string(100),
        ]);
    }

    public function down()
    {
        $this->dropTable('cryptocoin_users');
    }
}
