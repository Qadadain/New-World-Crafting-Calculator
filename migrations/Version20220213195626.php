<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213195626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, trade_skill_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_49FEA1571A81633 (trade_skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multiplicator (id INT AUTO_INCREMENT NOT NULL, multiplicator INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_skill (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_74303494C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_skill_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA1571A81633 FOREIGN KEY (trade_skill_id) REFERENCES trade_skill (id)');
        $this->addSql('ALTER TABLE trade_skill ADD CONSTRAINT FK_74303494C54C8C93 FOREIGN KEY (type_id) REFERENCES trade_skill_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA1571A81633');
        $this->addSql('ALTER TABLE trade_skill DROP FOREIGN KEY FK_74303494C54C8C93');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE multiplicator');
        $this->addSql('DROP TABLE trade_skill');
        $this->addSql('DROP TABLE trade_skill_type');
    }
}
