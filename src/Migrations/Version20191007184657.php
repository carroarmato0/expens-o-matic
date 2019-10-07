<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007184657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE expense_item (id INT AUTO_INCREMENT NOT NULL, expense_id_id INT NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_ABBC6B7CDC4C396D (expense_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_assignment (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, role_id_id INT NOT NULL, INDEX IDX_BFF12E969D86650F (user_id_id), INDEX IDX_BFF12E9688987678 (role_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, email VARCHAR(90) NOT NULL, password VARCHAR(255) NOT NULL, enabled SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, submit_date DATETIME NOT NULL, date DATE NOT NULL, name VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, approved SMALLINT DEFAULT NULL, reimbursed SMALLINT NOT NULL, INDEX IDX_2D3A8DA69D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expense_item ADD CONSTRAINT FK_ABBC6B7CDC4C396D FOREIGN KEY (expense_id_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE role_assignment ADD CONSTRAINT FK_BFF12E969D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE role_assignment ADD CONSTRAINT FK_BFF12E9688987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA69D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role_assignment DROP FOREIGN KEY FK_BFF12E9688987678');
        $this->addSql('ALTER TABLE role_assignment DROP FOREIGN KEY FK_BFF12E969D86650F');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA69D86650F');
        $this->addSql('ALTER TABLE expense_item DROP FOREIGN KEY FK_ABBC6B7CDC4C396D');
        $this->addSql('DROP TABLE expense_item');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_assignment');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE expense');
    }
}
