<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516205714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE planning_employee (planning_id INT NOT NULL, employee_id INT NOT NULL, INDEX IDX_6A9A230C3D865311 (planning_id), INDEX IDX_6A9A230C8C03F15C (employee_id), PRIMARY KEY(planning_id, employee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE planning_employee ADD CONSTRAINT FK_6A9A230C3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_employee ADD CONSTRAINT FK_6A9A230C8C03F15C FOREIGN KEY (employee_id) REFERENCES employees (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE employees CHANGE employee_photo employee_photo VARCHAR(50) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        // $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C30030B932B1 FOREIGN KEY (kpa_id) REFERENCES employee_category (id)');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_BA82C30030B932B1 ON employees (kpa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE planning_employee');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C30030B932B1');
        $this->addSql('DROP INDEX UNIQ_BA82C30030B932B1 ON employees');
        $this->addSql('ALTER TABLE employees CHANGE employee_photo employee_photo VARCHAR(50) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
