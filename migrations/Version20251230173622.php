<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251230173622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exemplaire DROP FOREIGN KEY `FK_5EF83C9215D884B5`');
        $this->addSql('ALTER TABLE exemplaire ADD CONSTRAINT FK_5EF83C9215D884B5 FOREIGN KEY (ouvrage_id) REFERENCES ouvrage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exemplaire DROP FOREIGN KEY FK_5EF83C9215D884B5');
        $this->addSql('ALTER TABLE exemplaire ADD CONSTRAINT `FK_5EF83C9215D884B5` FOREIGN KEY (ouvrage_id) REFERENCES ouvrage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
