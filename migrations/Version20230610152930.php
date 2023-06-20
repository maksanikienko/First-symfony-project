<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610152930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE favorite_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE favorite_product (id INT NOT NULL, user_id_id INT DEFAULT NULL, product_id_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8E1EAAC39D86650F ON favorite_product (user_id_id)');
        $this->addSql('CREATE INDEX IDX_8E1EAAC3DE18E50B ON favorite_product (product_id_id)');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC39D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC3DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE favorite_product_id_seq CASCADE');
        $this->addSql('ALTER TABLE favorite_product DROP CONSTRAINT FK_8E1EAAC39D86650F');
        $this->addSql('ALTER TABLE favorite_product DROP CONSTRAINT FK_8E1EAAC3DE18E50B');
        $this->addSql('DROP TABLE favorite_product');
    }
}
