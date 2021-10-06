<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006090446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, annonce_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', montant DOUBLE PRECISION NOT NULL, datatrans_id VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FE86641019EB6921 (client_id), INDEX IDX_FE8664108805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664108805AB2F FOREIGN KEY (annonce_id) REFERENCES announcement (id)');
        $this->addSql('ALTER TABLE announcement ADD promo_title VARCHAR(255) DEFAULT NULL, ADD is_paid TINYINT(1) NOT NULL, ADD montant_total DOUBLE PRECISION NOT NULL, DROP offert, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE start_at start_at DATETIME DEFAULT NULL, CHANGE end_at end_at DATETIME DEFAULT NULL, CHANGE options options INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98AF49C8B');
        $this->addSql('ALTER TABLE users CHANGE affiche_telephone affiche_telephone TINYINT(1) DEFAULT NULL, CHANGE civilite civilite VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE facture');
        $this->addSql('ALTER TABLE announcement ADD offert VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP promo_title, DROP is_paid, DROP montant_total, CHANGE updated_at updated_at DATETIME NOT NULL, CHANGE start_at start_at DATETIME NOT NULL, CHANGE end_at end_at DATETIME NOT NULL, CHANGE options options INT NOT NULL');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98AF49C8B');
        $this->addSql('ALTER TABLE users CHANGE affiche_telephone affiche_telephone TINYINT(1) NOT NULL, CHANGE civilite civilite VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
