<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210906014044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD start_at DATETIME NOT NULL, ADD end_at DATETIME NOT NULL, ADD is_verified TINYINT(1) NOT NULL, ADD offert VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP created_at, DROP updated_at, DROP start_at, DROP end_at, DROP is_verified, DROP offert');
    }
}
