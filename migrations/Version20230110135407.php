<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110135407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE construction_materials_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE construction_mixture_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE delivery_man_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pizza_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE supermarket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, content VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ref_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE delivery_man (id INT NOT NULL, name VARCHAR(255) NOT NULL, phone INT NOT NULL, status VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, car VARCHAR(255) NOT NULL, rating INT NOT NULL, availability BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, user_id INT NOT NULL, items VARCHAR(255) NOT NULL, total_price INT NOT NULL, status VARCHAR(255) NOT NULL, delivery_address VARCHAR(255) NOT NULL, deliveryman VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, notes VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pizza (id INT NOT NULL, name VARCHAR(255) NOT NULL, ingredients TEXT NOT NULL, price INT NOT NULL, description VARCHAR(255) NOT NULL, calories INT NOT NULL, size VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, discount INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN pizza.ingredients IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE supermarket (id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number INT NOT NULL, email VARCHAR(255) NOT NULL, opened_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, closed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description VARCHAR(255) NOT NULL, rating INT NOT NULL, is_opened BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN supermarket.opened_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN supermarket.closed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, age INT NOT NULL, gender VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP TABLE construction_materials');
        $this->addSql('DROP TABLE construction_mixture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE delivery_man_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE pizza_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE supermarket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE construction_materials_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE construction_mixture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE construction_materials (id INT NOT NULL, bag_of_cement VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE construction_mixture (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE delivery_man');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE supermarket');
        $this->addSql('DROP TABLE "user"');
    }
}
