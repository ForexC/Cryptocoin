<?php

use yii\db\Migration;

class m160229_142738_create_pays_table extends Migration
{
    public function up()
    {
        $this->createTable('cryptocoin_pays', [
            'id' => $this->primaryKey(),
            'created_date' => $this->integer(),
            'user_id' => $this->integer(),
            'address' => $this->string(100),
            'amount' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('cryptocoin_pays');
    }
}
