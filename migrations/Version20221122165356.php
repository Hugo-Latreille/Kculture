<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122165356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_has_questions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game_has_questions (id INT NOT NULL, game_id INT NOT NULL, question_id INT NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_19D5AF1E48FD905 ON game_has_questions (game_id)');
        $this->addSql('CREATE INDEX IDX_19D5AF11E27F6BF ON game_has_questions (question_id)');
        $this->addSql('ALTER TABLE game_has_questions ADD CONSTRAINT FK_19D5AF1E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_has_questions ADD CONSTRAINT FK_19D5AF11E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT fk_1db3b668e48fd905');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT fk_1db3b6681e27f6bf');
        $this->addSql('DROP TABLE game_question');
        $this->addSql('ALTER TABLE answer ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE answer ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE game ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE game ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE game_has_user ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE game_has_user ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE message ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE message ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE question ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE question ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE score ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE score ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE user_answer ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE user_answer ADD updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE game_has_questions_id_seq CASCADE');
        $this->addSql('CREATE TABLE game_question (game_id INT NOT NULL, question_id INT NOT NULL, PRIMARY KEY(game_id, question_id))');
        $this->addSql('CREATE INDEX idx_1db3b6681e27f6bf ON game_question (question_id)');
        $this->addSql('CREATE INDEX idx_1db3b668e48fd905 ON game_question (game_id)');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT fk_1db3b668e48fd905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT fk_1db3b6681e27f6bf FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_has_questions DROP CONSTRAINT FK_19D5AF1E48FD905');
        $this->addSql('ALTER TABLE game_has_questions DROP CONSTRAINT FK_19D5AF11E27F6BF');
        $this->addSql('DROP TABLE game_has_questions');
        $this->addSql('ALTER TABLE game DROP created_at');
        $this->addSql('ALTER TABLE game DROP updated_at');
        $this->addSql('ALTER TABLE game_has_user DROP created_at');
        $this->addSql('ALTER TABLE game_has_user DROP updated_at');
        $this->addSql('ALTER TABLE score DROP created_at');
        $this->addSql('ALTER TABLE score DROP updated_at');
        $this->addSql('ALTER TABLE user_answer DROP created_at');
        $this->addSql('ALTER TABLE user_answer DROP updated_at');
        $this->addSql('ALTER TABLE answer DROP created_at');
        $this->addSql('ALTER TABLE answer DROP updated_at');
        $this->addSql('ALTER TABLE message DROP created_at');
        $this->addSql('ALTER TABLE message DROP updated_at');
        $this->addSql('ALTER TABLE question DROP created_at');
        $this->addSql('ALTER TABLE question DROP updated_at');
    }
}
