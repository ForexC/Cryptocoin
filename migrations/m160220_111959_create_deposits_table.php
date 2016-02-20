<?php

use yii\db\Migration;

class m160220_111959_create_deposits_table extends Migration
{
    public function up()
    {
        $this->createTable('cryptocoin_deposits', [
            'id' => $this->primaryKey(),
            'created_date' => $this->integer(),
            'updated_date' => $this->integer(),
            'currency' => $this->string(100),
            'address' => $this->string(100),
            'pay_address' => $this->string(100),
            'amount' => $this->integer(),
            'pay_amount' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('cryptocoin_deposits');
    }
}
