<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213164439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, crafter_component_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_49FEA1579921E7E0 (crafter_component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crafter_component (id INT AUTO_INCREMENT NOT NULL, multiplicator_id INT NOT NULL, INDEX IDX_B596BFDDE58E04A6 (multiplicator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multiplicator (id INT AUTO_INCREMENT NOT NULL, multiplicator INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_skill (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_74303494C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_skill_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA1579921E7E0 FOREIGN KEY (crafter_component_id) REFERENCES crafter_component (id)');
        $this->addSql('ALTER TABLE crafter_component ADD CONSTRAINT FK_B596BFDDE58E04A6 FOREIGN KEY (multiplicator_id) REFERENCES multiplicator (id)');
        $this->addSql('ALTER TABLE trade_skill ADD CONSTRAINT FK_74303494C54C8C93 FOREIGN KEY (type_id) REFERENCES trade_skill_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA1579921E7E0');
        $this->addSql('ALTER TABLE crafter_component DROP FOREIGN KEY FK_B596BFDDE58E04A6');
        $this->addSql('ALTER TABLE trade_skill DROP FOREIGN KEY FK_74303494C54C8C93');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE crafter_component');
        $this->addSql('DROP TABLE multiplicator');
        $this->addSql('DROP TABLE trade_skill');
        $this->addSql('DROP TABLE trade_skill_type');
    }
}
