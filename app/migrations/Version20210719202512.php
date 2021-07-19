<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719202512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE pays_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ref_type_genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ref_type_produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pays (id INT NOT NULL, alpha3 VARCHAR(3) NOT NULL, nom_fr VARCHAR(100) NOT NULL, nom_uk VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_349F3CAEC065E6E4 ON pays (alpha3)');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, country INT NOT NULL, title VARCHAR(255) NOT NULL, original_title VARCHAR(255) DEFAULT NULL, year INT NOT NULL, description TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, ranking INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29A5EC275373C966 ON produit (country)');
        $this->addSql('COMMENT ON COLUMN produit.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN produit.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN produit.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE produit_ref_type_genre (produit_id INT NOT NULL, ref_type_genre_id INT NOT NULL, PRIMARY KEY(produit_id, ref_type_genre_id))');
        $this->addSql('CREATE INDEX IDX_EADCFA64F347EFB ON produit_ref_type_genre (produit_id)');
        $this->addSql('CREATE INDEX IDX_EADCFA64AB39A383 ON produit_ref_type_genre (ref_type_genre_id)');
        $this->addSql('CREATE TABLE produit_ref_type_produit (produit_id INT NOT NULL, ref_type_produit_id INT NOT NULL, PRIMARY KEY(produit_id, ref_type_produit_id))');
        $this->addSql('CREATE INDEX IDX_16E93AA9F347EFB ON produit_ref_type_produit (produit_id)');
        $this->addSql('CREATE INDEX IDX_16E93AA982C5237E ON produit_ref_type_produit (ref_type_produit_id)');
        $this->addSql('CREATE TABLE ref_type_genre (id INT NOT NULL, genre_parent_id INT DEFAULT NULL, libelle VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B995B11C71958BE ON ref_type_genre (genre_parent_id)');
        $this->addSql('COMMENT ON COLUMN ref_type_genre.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN ref_type_genre.update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE ref_type_produit (id INT NOT NULL, libelle VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN ref_type_produit.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN ref_type_produit.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC275373C966 FOREIGN KEY (country) REFERENCES pays (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_ref_type_genre ADD CONSTRAINT FK_EADCFA64F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_ref_type_genre ADD CONSTRAINT FK_EADCFA64AB39A383 FOREIGN KEY (ref_type_genre_id) REFERENCES ref_type_genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_ref_type_produit ADD CONSTRAINT FK_16E93AA9F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_ref_type_produit ADD CONSTRAINT FK_16E93AA982C5237E FOREIGN KEY (ref_type_produit_id) REFERENCES ref_type_produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ref_type_genre ADD CONSTRAINT FK_8B995B11C71958BE FOREIGN KEY (genre_parent_id) REFERENCES ref_type_genre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC275373C966');
        $this->addSql('ALTER TABLE produit_ref_type_genre DROP CONSTRAINT FK_EADCFA64F347EFB');
        $this->addSql('ALTER TABLE produit_ref_type_produit DROP CONSTRAINT FK_16E93AA9F347EFB');
        $this->addSql('ALTER TABLE produit_ref_type_genre DROP CONSTRAINT FK_EADCFA64AB39A383');
        $this->addSql('ALTER TABLE ref_type_genre DROP CONSTRAINT FK_8B995B11C71958BE');
        $this->addSql('ALTER TABLE produit_ref_type_produit DROP CONSTRAINT FK_16E93AA982C5237E');
        $this->addSql('DROP SEQUENCE pays_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ref_type_genre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ref_type_produit_id_seq CASCADE');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_ref_type_genre');
        $this->addSql('DROP TABLE produit_ref_type_produit');
        $this->addSql('DROP TABLE ref_type_genre');
        $this->addSql('DROP TABLE ref_type_produit');
    }
}
