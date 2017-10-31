<?php

use Phinx\Migration\AbstractMigration;

class Companys extends AbstractMigration {

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
       
        $table = $this->table('companies');
        $table->addColumn('empresa', 'integer')
                ->addColumn('name', 'string', ['limit' => 100])
                ->addColumn('fantasia', 'string', ['limit' => 100])
                ->addColumn('alias', 'string', ['limit' => 100])
                ->addColumn('email', 'string', ['limit' => 100])
                ->addColumn('cover', 'string', [
                    'limit' => 250,
                    'default' => '/uploads/images/no_image.jpg'
                ])
                ->addColumn('document', 'string', [
                    'limit' => 20,
                    'default' => '000.000.000-81'])
                ->addColumn('phone', 'string', [
                    'limit' => 20,
                    'default' => '(48)3535-1603'])
                ->addColumn('cel', 'string', [
                    'limit' => 20,
                    'default' => '(48)99843-7067'])
                ->addColumn('zipcode', 'string', [
                    'limit' => 20,
                    'default' => '00000-000'])
                ->addColumn('street', 'string', [
                    'limit' => 100,
                    'default' => 'Oscar de Oliveira Lopes'])
                ->addColumn('district', 'string', [
                    'limit' => 100,
                    'default' => 'Bela Vista'])
                ->addColumn('number', 'string', [
                    'limit' => 100,
                    'default' => '355'])
                ->addColumn('complement', 'string', [
                    'limit' => 100,
                    'default' => 'Casa'])
                ->addColumn('city', 'string', [
                    'limit' => 100,
                    'default' => 'Jacinto Machado'])
                ->addColumn('state', 'string', [
                    'limit' => 2,
                    'default' => 'SC'])
                ->addColumn('country', 'string', [
                    'limit' => 30,
                    'default' => 'BRASIL'])
                ->addColumn('status', 'integer', ['default' => 1])
                ->addColumn('updated_at', 'datetime')
                ->addColumn('created_at', 'datetime')
                ->addIndex(['email'], ['unique' => true])
                ->create();
    }

}
