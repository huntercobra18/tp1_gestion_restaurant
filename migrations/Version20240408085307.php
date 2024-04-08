<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408085307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, phone INT NOT NULL, address VARCHAR(500) NOT NULL, fidelity_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, serveur_id INT NOT NULL, chef_id INT NOT NULL, ordered_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', prepared_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', served_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', billed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C510FF8019EB6921 (client_id), INDEX IDX_C510FF80B8F06499 (serveur_id), INDEX IDX_C510FF80150A48F1 (chef_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_client_plat (commande_client_id INT NOT NULL, plat_id INT NOT NULL, INDEX IDX_B855E4049E73363 (commande_client_id), INDEX IDX_B855E404D73DB560 (plat_id), PRIMARY KEY(commande_client_id, plat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_fournisseur (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, fournisseur_id INT NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7F6F4F53F347EFB (produit_id), INDEX IDX_7F6F4F53670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, rib VARCHAR(255) NOT NULL, phone VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat_produit (plat_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_AEF46CC0D73DB560 (plat_id), INDEX IDX_AEF46CC0F347EFB (produit_id), PRIMARY KEY(plat_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price TINYINT(1) NOT NULL, number INT NOT NULL, minimal_number INT NOT NULL, INDEX IDX_29A5EC27670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, validation_id VARCHAR(255) NOT NULL, phone INT NOT NULL, address VARCHAR(500) NOT NULL, disponibility VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_client ADD CONSTRAINT FK_C510FF8019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande_client ADD CONSTRAINT FK_C510FF80B8F06499 FOREIGN KEY (serveur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_client ADD CONSTRAINT FK_C510FF80150A48F1 FOREIGN KEY (chef_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_client_plat ADD CONSTRAINT FK_B855E4049E73363 FOREIGN KEY (commande_client_id) REFERENCES commande_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_client_plat ADD CONSTRAINT FK_B855E404D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F53F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F53670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE plat_produit ADD CONSTRAINT FK_AEF46CC0D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_produit ADD CONSTRAINT FK_AEF46CC0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_client DROP FOREIGN KEY FK_C510FF8019EB6921');
        $this->addSql('ALTER TABLE commande_client DROP FOREIGN KEY FK_C510FF80B8F06499');
        $this->addSql('ALTER TABLE commande_client DROP FOREIGN KEY FK_C510FF80150A48F1');
        $this->addSql('ALTER TABLE commande_client_plat DROP FOREIGN KEY FK_B855E4049E73363');
        $this->addSql('ALTER TABLE commande_client_plat DROP FOREIGN KEY FK_B855E404D73DB560');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F53F347EFB');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F53670C757F');
        $this->addSql('ALTER TABLE plat_produit DROP FOREIGN KEY FK_AEF46CC0D73DB560');
        $this->addSql('ALTER TABLE plat_produit DROP FOREIGN KEY FK_AEF46CC0F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27670C757F');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande_client');
        $this->addSql('DROP TABLE commande_client_plat');
        $this->addSql('DROP TABLE commande_fournisseur');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE plat_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE user');
    }
}
