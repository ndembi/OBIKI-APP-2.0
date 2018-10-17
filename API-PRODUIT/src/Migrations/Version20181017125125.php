<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181017125125 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE pharmacie');
        $this->addSql('DROP TABLE pharmacien');
        $this->addSql('DROP TABLE proprietaire');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, address VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, age INT NOT NULL, sexe TINYINT(1) NOT NULL, phone VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie (id INT AUTO_INCREMENT NOT NULL, id_ville INT NOT NULL, id_pharmacien INT NOT NULL, id_proprietaire INT NOT NULL, name VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, address VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacien (id INT AUTO_INCREMENT NOT NULL, id_pharmacie INT NOT NULL, siren INT NOT NULL, name VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, address VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, phone VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, id_ville INT NOT NULL, id_proprietaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, mail VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
