<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222232235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, trade_skill_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_49FEA1571A81633 (trade_skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DA88B137933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step_recipe (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_F7967C4D59D8A214 (recipe_id), INDEX IDX_F7967C4D933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_skill (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_74303494C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_skill_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA1571A81633 FOREIGN KEY (trade_skill_id) REFERENCES trade_skill (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137933FE08C FOREIGN KEY (ingredient_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE step_recipe ADD CONSTRAINT FK_F7967C4D59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE step_recipe ADD CONSTRAINT FK_F7967C4D933FE08C FOREIGN KEY (ingredient_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE trade_skill ADD CONSTRAINT FK_74303494C54C8C93 FOREIGN KEY (type_id) REFERENCES trade_skill_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137933FE08C');
        $this->addSql('ALTER TABLE step_recipe DROP FOREIGN KEY FK_F7967C4D933FE08C');
        $this->addSql('ALTER TABLE step_recipe DROP FOREIGN KEY FK_F7967C4D59D8A214');
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA1571A81633');
        $this->addSql('ALTER TABLE trade_skill DROP FOREIGN KEY FK_74303494C54C8C93');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE step_recipe');
        $this->addSql('DROP TABLE trade_skill');
        $this->addSql('DROP TABLE trade_skill_type');
    }
}
