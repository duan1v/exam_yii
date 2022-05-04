<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%supplier}}`.
 */
class m220503_150953_create_supplier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->db->createCommand('drop table if exists supplier;')->query();
        $this->createTable('{{%supplier}}', [
            'id'       => $this->primaryKey(),
            'name'     => $this->string(50)->defaultValue('')->notNull(),
            'code'     => $this->char(3)->defaultValue(NULL),
            't_status' => $this->string(10)->defaultValue('ok')->notNull(),
        ],$tableOptions);
        $this->createIndex('uk_code','supplier','code',true);
        $sql=<<<SQL
ALTER TABLE `supplier`
MODIFY COLUMN `code`  char(3) CHARACTER SET ascii NULL DEFAULT NULL AFTER `name`,
MODIFY COLUMN `t_status`  enum('ok','hold') CHARACTER SET ascii NOT NULL DEFAULT 'ok' AFTER `code`;
SQL;
        $this->db->createCommand($sql)->queryAll();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%supplier}}');
    }
}
