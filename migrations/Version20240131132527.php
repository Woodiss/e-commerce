<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131132527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F13EEE31F6');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1CDDE4EF6');
        $this->addSql('DROP INDEX UNIQ_835379F1CDDE4EF6 ON orders_details');
        $this->addSql('DROP INDEX IDX_835379F13EEE31F6 ON orders_details');
        $this->addSql('ALTER TABLE orders_details ADD orders_id INT DEFAULT NULL, ADD voyages_id INT DEFAULT NULL, DROP orders_id_id, DROP voyages_id_id');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1A170CAB9 FOREIGN KEY (voyages_id) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX IDX_835379F1CFFE9AD6 ON orders_details (orders_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_835379F1A170CAB9 ON orders_details (voyages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1CFFE9AD6');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1A170CAB9');
        $this->addSql('DROP INDEX IDX_835379F1CFFE9AD6 ON orders_details');
        $this->addSql('DROP INDEX UNIQ_835379F1A170CAB9 ON orders_details');
        $this->addSql('ALTER TABLE orders_details ADD orders_id_id INT DEFAULT NULL, ADD voyages_id_id INT DEFAULT NULL, DROP orders_id, DROP voyages_id');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F13EEE31F6 FOREIGN KEY (orders_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1CDDE4EF6 FOREIGN KEY (voyages_id_id) REFERENCES voyage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_835379F1CDDE4EF6 ON orders_details (voyages_id_id)');
        $this->addSql('CREATE INDEX IDX_835379F13EEE31F6 ON orders_details (orders_id_id)');
    }
}
