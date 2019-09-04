<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190804090632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hotel CHANGE name name VARCHAR(70) NOT NULL, CHANGE address address VARCHAR(100) NOT NULL, CHANGE city city VARCHAR(70) NOT NULL, CHANGE path path VARCHAR(70) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hotel CHANGE name name VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE address address VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE city city VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE path path VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
