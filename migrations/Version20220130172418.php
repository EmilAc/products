<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130172418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE product DROP category_name');
//        $this->addSql('ALTER TABLE product DROP department_name');
//        $this->addSql('ALTER TABLE product DROP manufacturer_name');
//        $this->addSql('ALTER TABLE product ADD category_id VARCHAR(128) NOT NULL');
//        $this->addSql('ALTER TABLE product ADD department_id VARCHAR(128) NOT NULL');
//        $this->addSql('ALTER TABLE product ADD manufacturer_id VARCHAR(128) NOT NULL');
//        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
//        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
//        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
//        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
//        $this->addSql('CREATE INDEX IDX_D34A04ADAE80F5DF ON product (department_id)');
//        $this->addSql('CREATE INDEX IDX_D34A04ADA23B42D ON product (manufacturer_id)');
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
//        $this->addSql('DROP TABLE temp');
    }
}
