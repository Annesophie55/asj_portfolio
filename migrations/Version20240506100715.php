<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506100715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_technology RENAME INDEX idx_6fb9686c46e90e27 TO IDX_1BC2EDF146E90E27');
        $this->addSql('ALTER TABLE experience_technology RENAME INDEX idx_6fb9686c261a27d2 TO IDX_1BC2EDF14235D463');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin_user');
        $this->addSql('ALTER TABLE experience_technology RENAME INDEX idx_1bc2edf14235d463 TO IDX_6FB9686C261A27D2');
        $this->addSql('ALTER TABLE experience_technology RENAME INDEX idx_1bc2edf146e90e27 TO IDX_6FB9686C46E90E27');
    }
}
