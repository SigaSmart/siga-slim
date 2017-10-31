<?php

use Phinx\Migration\AbstractMigration;

class BrandProducts extends AbstractMigration {

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
        $table = $this->table('brand_products');
        $table->addColumn('empresa', 'integer')
                ->addColumn('product_id', 'integer')
                ->addColumn('brand_id', 'integer')
                ->addColumn('updated_at', 'datetime')
                ->addColumn('created_at', 'datetime')
                ->addForeignKey('product_id', 'products', ['id'], ['delete' => Phinx\Db\Table\ForeignKey::CASCADE, 'constraint' => 'products_category_id'])
                ->addForeignKey('brand_id', 'brands', ['id'], ['delete' => Phinx\Db\Table\ForeignKey::CASCADE, 'constraint' => 'brands_category_id'])
                ->create();
    }

}
