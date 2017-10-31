<?php

use Phinx\Migration\AbstractMigration;

class Roles extends AbstractMigration {

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
        $table = $this->table('roles');
        $table->addColumn('empresa', 'integer')
                ->addColumn('parent', 'integer')
                ->addColumn('name', 'string', ['limit' => 40])
                ->addColumn('alias', 'string', ['limit' => 40])
                ->addColumn('status', 'integer', ['default' => 1])
                ->addColumn('updated_at', 'datetime')
                ->addColumn('created_at', 'datetime')
                ->addIndex(['alias'], ['unique' => true])
                ->create();
    }

}
