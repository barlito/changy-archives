<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231205191503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add base entities for PoC';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE document (id UUID NOT NULL, resource_id UUID NOT NULL, document_name VARCHAR(255) DEFAULT NULL, document_size INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8698A7689329D25 ON document (resource_id)');
        $this->addSql('CREATE TABLE image (id UUID NOT NULL, resource_id UUID NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C53D045F89329D25 ON image (resource_id)');
        $this->addSql('CREATE TABLE resource (id UUID NOT NULL, title VARCHAR(255) NOT NULL, period VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, environment VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7689329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A7689329D25');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F89329D25');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE resource');
    }
}
