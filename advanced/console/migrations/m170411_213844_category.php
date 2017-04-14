<?php

use yii\db\Migration;

class m170411_213844_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

          $this->insert('category',['name'=>'Mobiles']
          );
           $this->insert('category',['name'=>'Cars']
          );
            $this->insert('category',['name'=>'Tablets']
          );
         
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
