<?php

use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration {

    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change() {
        $table = $this->table('users');
        $table->addColumn('empresa', 'integer')
                ->addColumn('first_name', 'string', ['limit' => 40])
                ->addColumn('last_name', 'string', ['limit' => 40])
                ->addColumn('email', 'string', ['limit' => 100])
                ->addColumn('cover', 'string', [
                    'limit' => 250,
                    'default' => '/uploads/images/no_image.jpg'
                ])
                ->addColumn('password', 'string', ['limit' => 255])
                ->addColumn('status', 'integer', ['default' => 1])
                ->addColumn('role', 'string', [
                    'limit' => 40,
                    'default' => 'clients'])
                ->addColumn('updated_at', 'datetime')
                ->addColumn('created_at', 'datetime')
                ->addIndex(['email'], ['unique' => true])
                ->create();
    }

}
