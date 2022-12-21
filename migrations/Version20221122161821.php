<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122161821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_has_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game_has_user (id INT NOT NULL, user_id_id INT NOT NULL, game_id INT NOT NULL, is_game_master BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B8BF2309D86650F ON game_has_user (user_id_id)');
        $this->addSql('CREATE INDEX IDX_7B8BF230E48FD905 ON game_has_user (game_id)');
        $this->addSql('ALTER TABLE game_has_user ADD CONSTRAINT FK_7B8BF2309D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_has_user ADD CONSTRAINT FK_7B8BF230E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE game_has_user_id_seq CASCADE');
        $this->addSql('ALTER TABLE game_has_user DROP CONSTRAINT FK_7B8BF2309D86650F');
        $this->addSql('ALTER TABLE game_has_user DROP CONSTRAINT FK_7B8BF230E48FD905');
        $this->addSql('DROP TABLE game_has_user');
    }
}
