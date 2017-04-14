<?php

use yii\db\Migration;

class m170411_213844_user_admin extends Migration
{
   public function up()
    {
        $this->insert('user', array(
         'username'=>'admin',
         'email' => 'admin@admin.com',
         'password_hash' => '$2y$13$5o8JWVJSq0O8TnYneGlr5.BhKcO5gBDzUaS9.m6HACx95mIZzDP1e',
         'Auth_key' => 'FjYjJFVVYaGhGMmMwVFCYBkSBU6hpGu4'
        ));
    }

    public function down()
    {
        $this->delete('user', ['username' => 'admin']);
    }
}
