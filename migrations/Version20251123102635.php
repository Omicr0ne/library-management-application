<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251123102635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ouvrage ADD titre VARCHAR(60) NOT NULL, ADD auteurs VARCHAR(60) NOT NULL, ADD éditeur VARCHAR(60) NOT NULL, ADD isbn_issn VARCHAR(20) NOT NULL, ADD catégories VARCHAR(255) NOT NULL, ADD tags VARCHAR(255) DEFAULT NULL, ADD langues VARCHAR(255) NOT NULL, ADD année VARCHAR(10) NOT NULL, ADD résumé VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ouvrage DROP titre, DROP auteurs, DROP éditeur, DROP isbn_issn, DROP catégories, DROP tags, DROP langues, DROP année, DROP résumé, DROP created_at');
    }
}
