<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321152903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f5299398ed766068');
        $this->addSql('DROP INDEX idx_f5299398ed766068');
        $this->addSql('ALTER TABLE "order" RENAME COLUMN username_id TO user_id');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON "order" (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398A76ED395');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395');
        $this->addSql('ALTER TABLE "order" RENAME COLUMN user_id TO username_id');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f5299398ed766068 FOREIGN KEY (username_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f5299398ed766068 ON "order" (username_id)');
    }
}
