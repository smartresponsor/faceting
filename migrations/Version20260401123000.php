<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260401123000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial facet table for the Faceting component.';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('facet')) {
            return;
        }

        $table = $schema->createTable('facet');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('code', 'string', ['length' => 64]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('type', 'string', ['length' => 32]);
        $table->addColumn('visible', 'boolean');
        $table->addColumn('position', 'integer');
        $table->addColumn('created_at', 'datetime_immutable');
        $table->addColumn('updated_at', 'datetime_immutable');
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['code'], 'uniq_facet_code');
        $table->addIndex(['visible', 'position'], 'idx_facet_visible_position');
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('facet')) {
            $schema->dropTable('facet');
        }
    }
}
