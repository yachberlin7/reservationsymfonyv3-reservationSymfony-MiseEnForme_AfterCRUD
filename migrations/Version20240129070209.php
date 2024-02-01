<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129070209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jour_menu (id INT AUTO_INCREMENT NOT NULL, semaine_resa_id INT NOT NULL, date_jour DATE NOT NULL, INDEX IDX_38374350CBC7387E (semaine_resa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repas_menu (id INT AUTO_INCREMENT NOT NULL, type_repas_id INT NOT NULL, jour_menu_id INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_EDE7ED03D0DC4D56 (type_repas_id), INDEX IDX_EDE7ED0369145271 (jour_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, repas_menu_id INT NOT NULL, INDEX IDX_42C84955FB88E14F (utilisateur_id), INDEX IDX_42C84955B1B981FE (repas_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semaine_resa (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, numero_semaine INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_repas (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, tarif DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, identifiant VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jour_menu ADD CONSTRAINT FK_38374350CBC7387E FOREIGN KEY (semaine_resa_id) REFERENCES semaine_resa (id)');
        $this->addSql('ALTER TABLE repas_menu ADD CONSTRAINT FK_EDE7ED03D0DC4D56 FOREIGN KEY (type_repas_id) REFERENCES type_repas (id)');
        $this->addSql('ALTER TABLE repas_menu ADD CONSTRAINT FK_EDE7ED0369145271 FOREIGN KEY (jour_menu_id) REFERENCES jour_menu (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B1B981FE FOREIGN KEY (repas_menu_id) REFERENCES repas_menu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jour_menu DROP FOREIGN KEY FK_38374350CBC7387E');
        $this->addSql('ALTER TABLE repas_menu DROP FOREIGN KEY FK_EDE7ED03D0DC4D56');
        $this->addSql('ALTER TABLE repas_menu DROP FOREIGN KEY FK_EDE7ED0369145271');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FB88E14F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B1B981FE');
        $this->addSql('DROP TABLE jour_menu');
        $this->addSql('DROP TABLE promo');
        $this->addSql('DROP TABLE repas_menu');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE semaine_resa');
        $this->addSql('DROP TABLE type_repas');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
