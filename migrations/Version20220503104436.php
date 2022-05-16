<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503104436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tasks_customers (tasks_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_BF5AB983E3272D31 (tasks_id), INDEX IDX_BF5AB983C3568B40 (customers_id), PRIMARY KEY(tasks_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tasks_customers ADD CONSTRAINT FK_BF5AB983E3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_customers ADD CONSTRAINT FK_BF5AB983C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tasks_tasks');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tasks_tasks (tasks_source INT NOT NULL, tasks_target INT NOT NULL, INDEX IDX_E9D45E301781C503 (tasks_source), INDEX IDX_E9D45E30E64958C (tasks_target), PRIMARY KEY(tasks_source, tasks_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tasks_tasks ADD CONSTRAINT FK_E9D45E30E64958C FOREIGN KEY (tasks_target) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_tasks ADD CONSTRAINT FK_E9D45E301781C503 FOREIGN KEY (tasks_source) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tasks_customers');
    }
}
