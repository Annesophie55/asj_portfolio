<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430200829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experience_technology (experience_id INT NOT NULL, technology_id INT NOT NULL, INDEX IDX_6FB9686C46E90E27 (experience_id), INDEX IDX_6FB9686C261A27D2 (technology_id), PRIMARY KEY(experience_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_6FB9686C46E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_6FB9686C261A27D2 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience_technology DROP FOREIGN KEY FK_6FB9686C46E90E27');
        $this->addSql('ALTER TABLE experience_technology DROP FOREIGN KEY FK_6FB9686C261A27D2');
        $this->addSql('DROP TABLE experience_technology');
    }
}
