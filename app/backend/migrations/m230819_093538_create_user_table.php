<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230819_093538_create_user_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key'=>$this->string()->notNull()->unique(),
            'access_token' => $this->string()->unique(),
        ]);
        // creates index for column `tag_id`
        $this->createIndex(
            'access_tokenx-user-access_token',
            'user',
            'access_token'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `post_id`
        $this->dropIndex(
            'access_tokenx-user-access_token',
            'user'
        );

        $this->dropTable('user');
    }

}