<?php

use yii\db\Schema;
use yii\db\Migration;

class m150721_150634_add_table_books extends Migration
{

    public function safeUp()
    {
        $this->createTable('books', array(
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'date_create' => Schema::TYPE_DATETIME,
            'date_update' => Schema::TYPE_DATETIME,
            'preview' => Schema::TYPE_STRING,
            'date_published' => Schema::TYPE_DATETIME,
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL'

        ));

        $this->createTable('authors', array(
            'id' => Schema::TYPE_PK,
            'firstname' => Schema::TYPE_STRING,
            'lastname' => Schema::TYPE_STRING
        ));

        $this->addForeignKey('books_authors', 'books', 'author_id', 'authors', 'id', 'CASCADE', 'CASCADE');
    }
    
    public function safeDown()
    {
        $this->dropForeignKey('books_authors', 'books');
        $this->dropTable('authors');
        $this->dropTable('books');
    }

}
