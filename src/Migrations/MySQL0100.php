<?php

declare(strict_types=1);

namespace ProxiCMS\ContentBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class MySQL0100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'MySQL Version 0.1.0';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE proxicms_content (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(255) NOT NULL, category VARCHAR(160) DEFAULT NULL, name VARCHAR(255) NOT NULL, value LONGTEXT DEFAULT NULL, public TINYINT(1) NOT NULL, text_editor TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_7A7CEAE5772E836A (identifier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE proxicms_content');
    }
}
