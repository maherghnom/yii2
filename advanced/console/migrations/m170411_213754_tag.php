<?php

use yii\db\Migration;

class m170411_213754_tag extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),

            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

          $this->insert('tag',['name'=>'toyota']
          );
          $this->insert('tag',['name'=>'honda']
          );
          $this->insert('tag',['name'=>'gmc']
          );
          $this->insert('tag',['name'=>'automatic']
          );
          $this->insert('tag',['name'=>'manual']
          );
          $this->insert('tag',['name'=>'hybrid']
          );
          $this->insert('tag',['name'=>'gas']
          );
          $this->insert('tag',['name'=>'iphone']
          );
          $this->insert('tag',['name'=>'galaxy s']
          );
          $this->insert('tag',['name'=>'galaxy note']
          );
          $this->insert('tag',['name'=>'black']
          );
          $this->insert('tag',['name'=>'white']
          );
          $this->insert('tag',['name'=>'ipad']
          );
          $this->insert('tag',['name'=>'galaxy tab']
          );
         

         
    }

    public function down()
    {
        $this->dropTable('{{%tag}}');
    }
}
