<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503114325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees ADD kpa_id INT NOT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C30030B932B1 FOREIGN KEY (kpa_id) REFERENCES employee_category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA82C30030B932B1 ON employees (kpa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C30030B932B1');
        $this->addSql('DROP INDEX UNIQ_BA82C30030B932B1 ON employees');
        $this->addSql('ALTER TABLE employees DROP kpa_id');
    }
}
