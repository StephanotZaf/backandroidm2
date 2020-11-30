<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130124250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE approvisionnement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ligne_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_approvisionnement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE approvisionnement (id INT NOT NULL, date_approvisionnement DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commande (id INT NOT NULL, date_commande TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ligne_commande (id INT NOT NULL, produit_id INT NOT NULL, commande_id INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3170B74BF347EFB ON ligne_commande (produit_id)');
        $this->addSql('CREATE INDEX IDX_3170B74B82EA2E54 ON ligne_commande (commande_id)');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, libelle_produit VARCHAR(255) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, quantite_en_stock INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE produit_approvisionnement (id INT NOT NULL, approvisionnement_id INT NOT NULL, produit_id INT NOT NULL, quantite_approvisionnee INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B2FCADC7AE741A98 ON produit_approvisionnement (approvisionnement_id)');
        $this->addSql('CREATE INDEX IDX_B2FCADC7F347EFB ON produit_approvisionnement (produit_id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_approvisionnement ADD CONSTRAINT FK_B2FCADC7AE741A98 FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_approvisionnement ADD CONSTRAINT FK_B2FCADC7F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE produit_approvisionnement DROP CONSTRAINT FK_B2FCADC7AE741A98');
        $this->addSql('ALTER TABLE ligne_commande DROP CONSTRAINT FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP CONSTRAINT FK_3170B74BF347EFB');
        $this->addSql('ALTER TABLE produit_approvisionnement DROP CONSTRAINT FK_B2FCADC7F347EFB');
        $this->addSql('DROP SEQUENCE approvisionnement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ligne_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_approvisionnement_id_seq CASCADE');
        $this->addSql('DROP TABLE approvisionnement');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_approvisionnement');
    }
}
