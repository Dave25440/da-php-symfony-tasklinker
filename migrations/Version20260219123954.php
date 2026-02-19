<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219123954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1E7927C74 ON employee (email)');
        $this->addSql('ALTER TABLE project CHANGE archive archive TINYINT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY `FK_527EDB258C03F15C`');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5D9F75A1E7927C74 ON employee');
        $this->addSql('ALTER TABLE project CHANGE archive archive TINYINT NOT NULL');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB258C03F15C');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT `FK_527EDB258C03F15C` FOREIGN KEY (employee_id) REFERENCES employee (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
