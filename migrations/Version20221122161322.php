<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122161322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_game DROP CONSTRAINT fk_59aa7d45a76ed395');
        $this->addSql('ALTER TABLE user_game DROP CONSTRAINT fk_59aa7d45e48fd905');
        $this->addSql('DROP TABLE user_game');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE user_game (user_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(user_id, game_id))');
        $this->addSql('CREATE INDEX idx_59aa7d45e48fd905 ON user_game (game_id)');
        $this->addSql('CREATE INDEX idx_59aa7d45a76ed395 ON user_game (user_id)');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT fk_59aa7d45a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT fk_59aa7d45e48fd905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
