<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251125072154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ouvrage CHANGE éditeur editeur VARCHAR(60) NOT NULL, CHANGE catégories categories VARCHAR(255) NOT NULL, CHANGE année annee VARCHAR(10) NOT NULL, CHANGE résumé resume VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ouvrage CHANGE editeur éditeur VARCHAR(60) NOT NULL, CHANGE categories catégories VARCHAR(255) NOT NULL, CHANGE annee année VARCHAR(10) NOT NULL, CHANGE resume résumé VARCHAR(255) DEFAULT NULL');
    }
}
