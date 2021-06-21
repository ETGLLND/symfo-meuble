<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621131451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE furniture (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, craft_number INT DEFAULT 0 NOT NULL, INDEX IDX_665DDAB312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE furniture_material (furniture_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_28E5C249CF5485C3 (furniture_id), INDEX IDX_28E5C249E308AC6F (material_id), PRIMARY KEY(furniture_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, supplier_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_7CBE75952ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE furniture_material ADD CONSTRAINT FK_28E5C249CF5485C3 FOREIGN KEY (furniture_id) REFERENCES furniture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE furniture_material ADD CONSTRAINT FK_28E5C249E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75952ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE furniture DROP FOREIGN KEY FK_665DDAB312469DE2');
        $this->addSql('ALTER TABLE furniture_material DROP FOREIGN KEY FK_28E5C249CF5485C3');
        $this->addSql('ALTER TABLE furniture_material DROP FOREIGN KEY FK_28E5C249E308AC6F');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE75952ADD6D8C');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE furniture');
        $this->addSql('DROP TABLE furniture_material');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE supplier');
    }
}
