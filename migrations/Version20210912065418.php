<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210912065418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, google_user VARCHAR(50) NOT NULL, google_password VARCHAR(50) NOT NULL, ios_user VARCHAR(50) NOT NULL, ios_password VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, device_id INT NOT NULL, app_id INT NOT NULL, INDEX IDX_C744045594A4C7D4 (device_id), INDEX IDX_C74404557987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE device (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(32) NOT NULL, language VARCHAR(3) NOT NULL, operating_system VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, status SMALLINT NOT NULL, expire_date DATE DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_A3C664D319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(32) NOT NULL, token VARCHAR(100) NOT NULL, expire_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045594A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404557987212D FOREIGN KEY (app_id) REFERENCES application (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404557987212D');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D319EB6921');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045594A4C7D4');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE token');
    }
}
