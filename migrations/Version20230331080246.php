<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331080246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cepage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, card_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crus (id INT AUTO_INCREMENT NOT NULL, cepage_id INT NOT NULL, nom VARCHAR(30) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_C4E696FA8AC6BB8A (cepage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crus ADD CONSTRAINT FK_C4E696FA8AC6BB8A FOREIGN KEY (cepage_id) REFERENCES cepage (id)');
        $this->addSql('ALTER TABLE carte ADD public TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crus DROP FOREIGN KEY FK_C4E696FA8AC6BB8A');
        $this->addSql('DROP TABLE cepage');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE crus');
        $this->addSql('ALTER TABLE carte DROP public, DROP created_at, CHANGE description description VARCHAR(255) DEFAULT NULL');
    }
}
