<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131093702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_details (id INT AUTO_INCREMENT NOT NULL, orders_id_id INT DEFAULT NULL, voyages_id_id INT DEFAULT NULL, quantity INT NOT NULL, price INT NOT NULL, INDEX IDX_835379F13EEE31F6 (orders_id_id), UNIQUE INDEX UNIQ_835379F1CDDE4EF6 (voyages_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F13EEE31F6 FOREIGN KEY (orders_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1CDDE4EF6 FOREIGN KEY (voyages_id_id) REFERENCES voyage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F13EEE31F6');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1CDDE4EF6');
        $this->addSql('DROP TABLE orders_details');
    }
}
