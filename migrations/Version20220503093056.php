<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503093056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departments (id INT AUTO_INCREMENT NOT NULL, manager_id_id INT DEFAULT NULL, department_name VARCHAR(50) NOT NULL, department_desc VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_16AEB8D4569B5E6D (manager_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D4569B5E6D FOREIGN KEY (manager_id_id) REFERENCES employees (id)');
        $this->addSql('ALTER TABLE pointages CHANGE end_time end_time TIME NOT NULL, CHANGE justify justify LONGTEXT NOT NULL, CHANGE comments comments LONGTEXT NOT NULL, CHANGE validate validate VARCHAR(30) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE departments');
        $this->addSql('ALTER TABLE pointages CHANGE end_time end_time TIME DEFAULT NULL, CHANGE justify justify LONGTEXT DEFAULT NULL, CHANGE comments comments LONGTEXT DEFAULT NULL, CHANGE validate validate VARCHAR(30) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
