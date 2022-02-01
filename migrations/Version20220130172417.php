<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130172417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE temp(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE temp ADD product_number VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD category_name VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD department_name VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD manufacturer_name VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD upc VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD sku VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD regular_price VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD sale_price VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE temp ADD description VARCHAR(1024)');
    }


    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE category DROP id');
//        $this->addSql('ALTER TABLE category DROP id');
//        $this->addSql('ALTER TABLE category DROP category_name');
//        $this->addSql('ALTER TABLE department DROP department_name');
//        $this->addSql('ALTER TABLE manufacturer DROP manufacturer_name');
//        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
//        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADAE80F5DF');
//        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA23B42D');
        $this->addSql('DROP TABLE temp');
    }
}
