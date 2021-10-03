<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211003164847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, lundi_matin_ouverture TIME DEFAULT NULL, lundi_midi_fermeture TIME DEFAULT NULL, lundi_apmouverture TIME DEFAULT NULL, lundi_apmfermeture TIME DEFAULT NULL, mardi_matin_ouverture TIME DEFAULT NULL, mardi_midi_fermeture TIME DEFAULT NULL, mardi_apmouverture TIME DEFAULT NULL, mardi_apmfermeture TIME DEFAULT NULL, mercredi_matin_ouverture TIME DEFAULT NULL, mercredi_midi_fermeture TIME DEFAULT NULL, mercredi_apmouverture TIME DEFAULT NULL, mercredi_apmfermeture TIME DEFAULT NULL, jeudi_matin_ouverture TIME DEFAULT NULL, jeudi_midi_fermeture TIME DEFAULT NULL, jeudi_apmouverture TIME DEFAULT NULL, jeudi_apmfermeture TIME DEFAULT NULL, vendredi_matin_ouverture TIME DEFAULT NULL, vendredi_midi_fermeture TIME DEFAULT NULL, vendredi_apmouverture TIME DEFAULT NULL, vendredi_apmfermeture TIME DEFAULT NULL, samedi_matin_ouverture TIME DEFAULT NULL, samedi_midi_fermeture TIME DEFAULT NULL, samedi_apmouverture TIME DEFAULT NULL, samedi_apmfermeture TIME DEFAULT NULL, dimanche_matin_ouverture TIME DEFAULT NULL, dimanche_midi_fermeture TIME DEFAULT NULL, dimanche_apmouverture TIME DEFAULT NULL, dimanche_apmfermeture TIME DEFAULT NULL, UNIQUE INDEX UNIQ_39B7118FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE horaires ADD CONSTRAINT FK_39B7118FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC1067B3B43D');
        $this->addSql('DROP INDEX IDX_3781EC1067B3B43D ON delivery');
        $this->addSql('ALTER TABLE delivery ADD service VARCHAR(255) DEFAULT NULL, ADD hubereat VARCHAR(255) DEFAULT NULL, ADD est VARCHAR(255) DEFAULT NULL, ADD smood VARCHAR(255) DEFAULT NULL, ADD deindeal VARCHAR(255) DEFAULT NULL, DROP users_id, DROP name, DROP url');
        $this->addSql('ALTER TABLE replacement_advertising ADD title_possition VARCHAR(255) NOT NULL, ADD size VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD delivery_id INT DEFAULT NULL, ADD horaires_id INT DEFAULT NULL, ADD affiche_telephone TINYINT(1) NOT NULL, ADD date_naissance DATE DEFAULT NULL, ADD civilite VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E912136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E912136921 ON users (delivery_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E98AF49C8B ON users (horaires_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98AF49C8B');
        $this->addSql('DROP TABLE horaires');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE delivery ADD users_id INT NOT NULL, ADD name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP service, DROP hubereat, DROP est, DROP smood, DROP deindeal');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC1067B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3781EC1067B3B43D ON delivery (users_id)');
        $this->addSql('ALTER TABLE replacement_advertising DROP title_possition, DROP size');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E912136921');
        $this->addSql('DROP INDEX UNIQ_1483A5E912136921 ON users');
        $this->addSql('DROP INDEX UNIQ_1483A5E98AF49C8B ON users');
        $this->addSql('ALTER TABLE users DROP delivery_id, DROP horaires_id, DROP affiche_telephone, DROP date_naissance, DROP civilite');
    }
}
