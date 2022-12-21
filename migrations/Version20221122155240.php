<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122155240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE score_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, answer TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, game_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE game_question (game_id INT NOT NULL, question_id INT NOT NULL, PRIMARY KEY(game_id, question_id))');
        $this->addSql('CREATE INDEX IDX_1DB3B668E48FD905 ON game_question (game_id)');
        $this->addSql('CREATE INDEX IDX_1DB3B6681E27F6BF ON game_question (question_id)');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, user_id_id INT NOT NULL, game_id INT NOT NULL, message TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307F9D86650F ON message (user_id_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FE48FD905 ON message (game_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, answer_id INT DEFAULT NULL, question TEXT NOT NULL, level INT NOT NULL, timer INT NOT NULL, media TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494EAA334807 ON question (answer_id)');
        $this->addSql('CREATE TABLE score (id INT NOT NULL, user_id_id INT NOT NULL, game_id INT NOT NULL, score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_329937519D86650F ON score (user_id_id)');
        $this->addSql('CREATE INDEX IDX_32993751E48FD905 ON score (game_id)');
        $this->addSql('CREATE TABLE user_game (user_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(user_id, game_id))');
        $this->addSql('CREATE INDEX IDX_59AA7D45A76ED395 ON user_game (user_id)');
        $this->addSql('CREATE INDEX IDX_59AA7D45E48FD905 ON user_game (game_id)');
        $this->addSql('CREATE TABLE user_answer (id INT NOT NULL, user_id_id INT NOT NULL, question_id INT NOT NULL, game_id INT NOT NULL, answer TEXT NOT NULL, is_true BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF8F51189D86650F ON user_answer (user_id_id)');
        $this->addSql('CREATE INDEX IDX_BF8F51181E27F6BF ON user_answer (question_id)');
        $this->addSql('CREATE INDEX IDX_BF8F5118E48FD905 ON user_answer (game_id)');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT FK_1DB3B668E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT FK_1DB3B6681E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937519D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F51189D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F51181E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE score_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_answer_id_seq CASCADE');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B668E48FD905');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B6681E27F6BF');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F9D86650F');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307FE48FD905');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EAA334807');
        $this->addSql('ALTER TABLE score DROP CONSTRAINT FK_329937519D86650F');
        $this->addSql('ALTER TABLE score DROP CONSTRAINT FK_32993751E48FD905');
        $this->addSql('ALTER TABLE user_game DROP CONSTRAINT FK_59AA7D45A76ED395');
        $this->addSql('ALTER TABLE user_game DROP CONSTRAINT FK_59AA7D45E48FD905');
        $this->addSql('ALTER TABLE user_answer DROP CONSTRAINT FK_BF8F51189D86650F');
        $this->addSql('ALTER TABLE user_answer DROP CONSTRAINT FK_BF8F51181E27F6BF');
        $this->addSql('ALTER TABLE user_answer DROP CONSTRAINT FK_BF8F5118E48FD905');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_question');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE user_game');
        $this->addSql('DROP TABLE user_answer');
    }
}
