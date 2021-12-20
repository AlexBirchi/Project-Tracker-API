<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220205248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, reporter_id INT NOT NULL, asignee_id INT DEFAULT NULL, item_type_id INT NOT NULL, item_priority_id INT NOT NULL, project_id INT NOT NULL, number SMALLINT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, story_points SMALLINT DEFAULT NULL, INDEX IDX_1F1B251EE1CFE6F5 (reporter_id), INDEX IDX_1F1B251E63E0BCD7 (asignee_id), INDEX IDX_1F1B251ECE11AAC7 (item_type_id), INDEX IDX_1F1B251EA91341CF (item_priority_id), INDEX IDX_1F1B251E166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_comment (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, user_id INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_9F297438126F525E (item_id), INDEX IDX_9F297438A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_priority (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, tag VARCHAR(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_users (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, user_id INT NOT NULL, project_role_id INT DEFAULT NULL, INDEX IDX_7D6AC77166D1F9C (project_id), INDEX IDX_7D6AC77A76ED395 (user_id), INDEX IDX_7D6AC77401D2EC9 (project_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprint (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_EF8055B7166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprint_item (sprint_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_24D98A328C24077B (sprint_id), INDEX IDX_24D98A32126F525E (item_id), PRIMARY KEY(sprint_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EE1CFE6F5 FOREIGN KEY (reporter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E63E0BCD7 FOREIGN KEY (asignee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251ECE11AAC7 FOREIGN KEY (item_type_id) REFERENCES item_type (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA91341CF FOREIGN KEY (item_priority_id) REFERENCES item_priority (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE item_comment ADD CONSTRAINT FK_9F297438126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_comment ADD CONSTRAINT FK_9F297438A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_users ADD CONSTRAINT FK_7D6AC77166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_users ADD CONSTRAINT FK_7D6AC77A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_users ADD CONSTRAINT FK_7D6AC77401D2EC9 FOREIGN KEY (project_role_id) REFERENCES project_role (id)');
        $this->addSql('ALTER TABLE sprint ADD CONSTRAINT FK_EF8055B7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE sprint_item ADD CONSTRAINT FK_24D98A328C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sprint_item ADD CONSTRAINT FK_24D98A32126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_comment DROP FOREIGN KEY FK_9F297438126F525E');
        $this->addSql('ALTER TABLE sprint_item DROP FOREIGN KEY FK_24D98A32126F525E');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA91341CF');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251ECE11AAC7');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E166D1F9C');
        $this->addSql('ALTER TABLE project_users DROP FOREIGN KEY FK_7D6AC77166D1F9C');
        $this->addSql('ALTER TABLE sprint DROP FOREIGN KEY FK_EF8055B7166D1F9C');
        $this->addSql('ALTER TABLE project_users DROP FOREIGN KEY FK_7D6AC77401D2EC9');
        $this->addSql('ALTER TABLE sprint_item DROP FOREIGN KEY FK_24D98A328C24077B');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EE1CFE6F5');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E63E0BCD7');
        $this->addSql('ALTER TABLE item_comment DROP FOREIGN KEY FK_9F297438A76ED395');
        $this->addSql('ALTER TABLE project_users DROP FOREIGN KEY FK_7D6AC77A76ED395');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_comment');
        $this->addSql('DROP TABLE item_priority');
        $this->addSql('DROP TABLE item_status');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_role');
        $this->addSql('DROP TABLE project_users');
        $this->addSql('DROP TABLE sprint');
        $this->addSql('DROP TABLE sprint_item');
        $this->addSql('DROP TABLE user');
    }
}
