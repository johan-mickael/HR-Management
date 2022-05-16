<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503111253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tasks_customers');
        $this->addSql('ALTER TABLE tasks ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_505865979395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('CREATE INDEX IDX_505865979395C3F3 ON tasks (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tasks_customers (tasks_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_BF5AB983E3272D31 (tasks_id), INDEX IDX_BF5AB983C3568B40 (customers_id), PRIMARY KEY(tasks_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tasks_customers ADD CONSTRAINT FK_BF5AB983C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_customers ADD CONSTRAINT FK_BF5AB983E3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_505865979395C3F3');
        $this->addSql('DROP INDEX IDX_505865979395C3F3 ON tasks');
        $this->addSql('ALTER TABLE tasks DROP customer_id');
    }
}
