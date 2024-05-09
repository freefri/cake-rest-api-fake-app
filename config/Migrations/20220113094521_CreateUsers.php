<?php

declare(strict_types = 1);

use App\Model\Table\AppTable;
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users',
            ['collation'=>'utf8mb4_unicode_ci']);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 160,
            'null' => false,
        ]);
        $table->addColumn('firstname', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('lastname', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('group_id', 'integer', [
            'default' => 3,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('access_level', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex(['email'], ['unique' => true]);
        $table->addIndex(['group_id']);
        $table->create();
    }
}
