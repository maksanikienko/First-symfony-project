<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613162759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorite_product DROP CONSTRAINT fk_8e1eaac39d86650f');
        $this->addSql('ALTER TABLE favorite_product DROP CONSTRAINT fk_8e1eaac3de18e50b');
        $this->addSql('DROP INDEX idx_8e1eaac3de18e50b');
        $this->addSql('DROP INDEX idx_8e1eaac39d86650f');
        $this->addSql('ALTER TABLE favorite_product ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite_product ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite_product DROP user_id_id');
        $this->addSql('ALTER TABLE favorite_product DROP product_id_id');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC319EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC34584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8E1EAAC319EB6921 ON favorite_product (client_id)');
        $this->addSql('CREATE INDEX IDX_8E1EAAC34584665A ON favorite_product (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE favorite_product DROP CONSTRAINT FK_8E1EAAC319EB6921');
        $this->addSql('ALTER TABLE favorite_product DROP CONSTRAINT FK_8E1EAAC34584665A');
        $this->addSql('DROP INDEX IDX_8E1EAAC319EB6921');
        $this->addSql('DROP INDEX IDX_8E1EAAC34584665A');
        $this->addSql('ALTER TABLE favorite_product ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite_product ADD product_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite_product DROP client_id');
        $this->addSql('ALTER TABLE favorite_product DROP product_id');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT fk_8e1eaac39d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT fk_8e1eaac3de18e50b FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8e1eaac3de18e50b ON favorite_product (product_id_id)');
        $this->addSql('CREATE INDEX idx_8e1eaac39d86650f ON favorite_product (user_id_id)');
    }
}
