<?php

use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m161225_094052_create_author_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'username'=> $this->string()->unique(),
            'email'=> $this->string()->unique(),
            'password'=> $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('author');
    }
}
