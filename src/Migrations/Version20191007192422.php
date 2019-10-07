<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007192422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Inserting initial Roles and Admin user';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO role (id, name, description) VALUES (1, "admin", "Admin Role")');
        $this->addSql('INSERT INTO role (id, name, description) VALUES (2, "user", "User Role")');
        $this->addSql('INSERT INTO role (id, name, description) VALUES (3, "approver", "Approver Role")');

        $this->addSql('INSERT INTO user (id, name, surname, email, password, enabled) VALUES (1, "admin", "admin", "admin@localhost", "admin", 1)');

        $this->addSql('INSERT INTO role_assignment (id, user_id_id, role_id_id) VALUES (1, 1, 1)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM role_assignment WHERE id=1');

        $this->addSql('DELETE FROM role WHERE id IN (1,2,3)');

        $this->addSql('DELETE FROM user WHERE id IN (1)');
    }
}
