<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129071219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promo ADD section_id INT NOT NULL');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFBD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_B0139AFBD823E37A ON promo (section_id)');
        $this->addSql('ALTER TABLE utilisateur ADD promo_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3D0C07AFF ON utilisateur (promo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFBD823E37A');
        $this->addSql('DROP INDEX IDX_B0139AFBD823E37A ON promo');
        $this->addSql('ALTER TABLE promo DROP section_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D0C07AFF');
        $this->addSql('DROP INDEX IDX_1D1C63B3D0C07AFF ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP promo_id');
    }
}
