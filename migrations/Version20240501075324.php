<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240501075324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experience_technology (experience_id INT NOT NULL, technology_id INT NOT NULL, INDEX IDX_1BC2EDF146E90E27 (experience_id), INDEX IDX_1BC2EDF14235D463 (technology_id), PRIMARY KEY(experience_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_1BC2EDF146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_1BC2EDF14235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_technologie DROP FOREIGN KEY FK_6FB9686C261A27D2');
        $this->addSql('ALTER TABLE experience_technologie DROP FOREIGN KEY FK_6FB9686C46E90E27');
        $this->addSql('DROP TABLE experience_technologie');
        $this->addSql('DROP TABLE technologie');
        $this->addSql('ALTER TABLE experience CHANGE duration role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experience_technologie (experience_id INT NOT NULL, technologie_id INT NOT NULL, INDEX IDX_6FB9686C261A27D2 (technologie_id), INDEX IDX_6FB9686C46E90E27 (experience_id), PRIMARY KEY(experience_id, technologie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE technologie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE experience_technologie ADD CONSTRAINT FK_6FB9686C261A27D2 FOREIGN KEY (technologie_id) REFERENCES technologie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_technologie ADD CONSTRAINT FK_6FB9686C46E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_technology DROP FOREIGN KEY FK_1BC2EDF146E90E27');
        $this->addSql('ALTER TABLE experience_technology DROP FOREIGN KEY FK_1BC2EDF14235D463');
        $this->addSql('DROP TABLE experience_technology');
        $this->addSql('DROP TABLE technology');
        $this->addSql('ALTER TABLE experience CHANGE role duration VARCHAR(255) NOT NULL');
    }
}
