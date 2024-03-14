<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306161947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_details DROP INDEX UNIQ_835379F1A170CAB9, ADD INDEX IDX_835379F1A170CAB9 (voyages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_details DROP INDEX IDX_835379F1A170CAB9, ADD UNIQUE INDEX UNIQ_835379F1A170CAB9 (voyages_id)');
    }
}
