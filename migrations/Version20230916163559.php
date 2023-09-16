<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230916163559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(200) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_quizz_categories (quizz_id INT NOT NULL, quizz_categories_id INT NOT NULL, INDEX IDX_6E65A8B8BA934BCD (quizz_id), INDEX IDX_6E65A8B8DC9A4DAC (quizz_categories_id), PRIMARY KEY(quizz_id, quizz_categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_choices (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, reponse LONGTEXT NOT NULL, is_correct TINYINT(1) DEFAULT NULL, INDEX IDX_6F2449ED1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_illustrations (id INT AUTO_INCREMENT NOT NULL, quizz_id INT DEFAULT NULL, question_id INT DEFAULT NULL, reponses_id INT DEFAULT NULL, file VARCHAR(255) DEFAULT NULL, INDEX IDX_FD82CD36BA934BCD (quizz_id), INDEX IDX_FD82CD361E27F6BF (question_id), INDEX IDX_FD82CD36E4084792 (reponses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_questions (id INT AUTO_INCREMENT NOT NULL, quizz_id INT DEFAULT NULL, question LONGTEXT NOT NULL, INDEX IDX_79E4F161BA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, quizz_id INT DEFAULT NULL, score INT DEFAULT NULL, INDEX IDX_7BA44B57A76ED395 (user_id), INDEX IDX_7BA44B57BA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_user_answers (id INT AUTO_INCREMENT NOT NULL, user_quizz_id INT DEFAULT NULL, question_id INT DEFAULT NULL, choice_id INT DEFAULT NULL, INDEX IDX_31F87E015A1EAFCD (user_quizz_id), INDEX IDX_31F87E011E27F6BF (question_id), INDEX IDX_31F87E01998666D1 (choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizz_quizz_categories ADD CONSTRAINT FK_6E65A8B8BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_quizz_categories ADD CONSTRAINT FK_6E65A8B8DC9A4DAC FOREIGN KEY (quizz_categories_id) REFERENCES quizz_categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_choices ADD CONSTRAINT FK_6F2449ED1E27F6BF FOREIGN KEY (question_id) REFERENCES quizz_questions (id)');
        $this->addSql('ALTER TABLE quizz_illustrations ADD CONSTRAINT FK_FD82CD36BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz_illustrations ADD CONSTRAINT FK_FD82CD361E27F6BF FOREIGN KEY (question_id) REFERENCES quizz_questions (id)');
        $this->addSql('ALTER TABLE quizz_illustrations ADD CONSTRAINT FK_FD82CD36E4084792 FOREIGN KEY (reponses_id) REFERENCES quizz_choices (id)');
        $this->addSql('ALTER TABLE quizz_questions ADD CONSTRAINT FK_79E4F161BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz_user ADD CONSTRAINT FK_7BA44B57A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quizz_user ADD CONSTRAINT FK_7BA44B57BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz_user_answers ADD CONSTRAINT FK_31F87E015A1EAFCD FOREIGN KEY (user_quizz_id) REFERENCES quizz_user (id)');
        $this->addSql('ALTER TABLE quizz_user_answers ADD CONSTRAINT FK_31F87E011E27F6BF FOREIGN KEY (question_id) REFERENCES quizz_questions (id)');
        $this->addSql('ALTER TABLE quizz_user_answers ADD CONSTRAINT FK_31F87E01998666D1 FOREIGN KEY (choice_id) REFERENCES quizz_choices (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_quizz_categories DROP FOREIGN KEY FK_6E65A8B8BA934BCD');
        $this->addSql('ALTER TABLE quizz_quizz_categories DROP FOREIGN KEY FK_6E65A8B8DC9A4DAC');
        $this->addSql('ALTER TABLE quizz_choices DROP FOREIGN KEY FK_6F2449ED1E27F6BF');
        $this->addSql('ALTER TABLE quizz_illustrations DROP FOREIGN KEY FK_FD82CD36BA934BCD');
        $this->addSql('ALTER TABLE quizz_illustrations DROP FOREIGN KEY FK_FD82CD361E27F6BF');
        $this->addSql('ALTER TABLE quizz_illustrations DROP FOREIGN KEY FK_FD82CD36E4084792');
        $this->addSql('ALTER TABLE quizz_questions DROP FOREIGN KEY FK_79E4F161BA934BCD');
        $this->addSql('ALTER TABLE quizz_user DROP FOREIGN KEY FK_7BA44B57A76ED395');
        $this->addSql('ALTER TABLE quizz_user DROP FOREIGN KEY FK_7BA44B57BA934BCD');
        $this->addSql('ALTER TABLE quizz_user_answers DROP FOREIGN KEY FK_31F87E015A1EAFCD');
        $this->addSql('ALTER TABLE quizz_user_answers DROP FOREIGN KEY FK_31F87E011E27F6BF');
        $this->addSql('ALTER TABLE quizz_user_answers DROP FOREIGN KEY FK_31F87E01998666D1');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE quizz_quizz_categories');
        $this->addSql('DROP TABLE quizz_categories');
        $this->addSql('DROP TABLE quizz_choices');
        $this->addSql('DROP TABLE quizz_illustrations');
        $this->addSql('DROP TABLE quizz_questions');
        $this->addSql('DROP TABLE quizz_user');
        $this->addSql('DROP TABLE quizz_user_answers');
    }
}
