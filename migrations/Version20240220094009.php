<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220094009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD billing_adresse_id INT DEFAULT NULL, ADD delivery_adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEC180B3CD FOREIGN KEY (billing_adresse_id) REFERENCES billing_adresse (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE53A24B78 FOREIGN KEY (delivery_adresse_id) REFERENCES delivery_adresse (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEC180B3CD ON orders (billing_adresse_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE53A24B78 ON orders (delivery_adresse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEC180B3CD');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE53A24B78');
        $this->addSql('DROP INDEX IDX_E52FFDEEC180B3CD ON orders');
        $this->addSql('DROP INDEX IDX_E52FFDEE53A24B78 ON orders');
        $this->addSql('ALTER TABLE orders DROP billing_adresse_id, DROP delivery_adresse_id');
    }
}
