<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004150509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE package_ad_textual (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, nbr_days INT NOT NULL, price_per_day DOUBLE PRECISION NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcement ADD sub_category_id INT DEFAULT NULL, ADD package_ad_textual_id INT DEFAULT NULL, ADD titlediscount VARCHAR(255) DEFAULT NULL, ADD options INT NOT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C4B4FCA4E FOREIGN KEY (package_ad_textual_id) REFERENCES package_ad_textual (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91CF7BFE87C ON announcement (sub_category_id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C4B4FCA4E ON announcement (package_ad_textual_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C4B4FCA4E');
        $this->addSql('DROP TABLE package_ad_textual');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91CF7BFE87C');
        $this->addSql('DROP INDEX IDX_4DB9D91CF7BFE87C ON announcement');
        $this->addSql('DROP INDEX IDX_4DB9D91C4B4FCA4E ON announcement');
        $this->addSql('ALTER TABLE announcement DROP sub_category_id, DROP package_ad_textual_id, DROP titlediscount, DROP options');
    }
}
