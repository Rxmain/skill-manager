<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210612115147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, type_experience_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, function VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, context VARCHAR(255) NOT NULL, realisations VARCHAR(255) NOT NULL, technical_environment VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_590C1033604B912 (type_experience_id), INDEX IDX_590C103A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_experience (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1033604B912 FOREIGN KEY (type_experience_id) REFERENCES type_experience (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103A4AEAFEA');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1033604B912');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE type_experience');
        $this->addSql('DROP TABLE user');
    }
}
