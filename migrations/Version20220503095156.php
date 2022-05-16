<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503095156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(50) NOT NULL, customer_name VARCHAR(50) NOT NULL, customer_surname VARCHAR(50) NOT NULL, customer_email VARCHAR(100) NOT NULL, customer_phone_number INT NOT NULL, customer_adress VARCHAR(255) NOT NULL, customer_code VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, task_id_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, desciption VARCHAR(255) NOT NULL, status VARCHAR(50) NOT NULL, INDEX IDX_E11EE94DB8E08577 (task_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks_departments (tasks_id INT NOT NULL, departments_id INT NOT NULL, INDEX IDX_A946DC09E3272D31 (tasks_id), INDEX IDX_A946DC09F1B3F295 (departments_id), PRIMARY KEY(tasks_id, departments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks_tasks (tasks_source INT NOT NULL, tasks_target INT NOT NULL, INDEX IDX_E9D45E301781C503 (tasks_source), INDEX IDX_E9D45E30E64958C (tasks_target), PRIMARY KEY(tasks_source, tasks_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DB8E08577 FOREIGN KEY (task_id_id) REFERENCES tasks (id)');
        $this->addSql('ALTER TABLE tasks_departments ADD CONSTRAINT FK_A946DC09E3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_departments ADD CONSTRAINT FK_A946DC09F1B3F295 FOREIGN KEY (departments_id) REFERENCES departments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_tasks ADD CONSTRAINT FK_E9D45E301781C503 FOREIGN KEY (tasks_source) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_tasks ADD CONSTRAINT FK_E9D45E30E64958C FOREIGN KEY (tasks_target) REFERENCES tasks (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DB8E08577');
        $this->addSql('ALTER TABLE tasks_departments DROP FOREIGN KEY FK_A946DC09E3272D31');
        $this->addSql('ALTER TABLE tasks_tasks DROP FOREIGN KEY FK_E9D45E301781C503');
        $this->addSql('ALTER TABLE tasks_tasks DROP FOREIGN KEY FK_E9D45E30E64958C');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE tasks_departments');
        $this->addSql('DROP TABLE tasks_tasks');
    }
}
