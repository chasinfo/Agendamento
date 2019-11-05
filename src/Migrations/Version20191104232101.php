<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191104232101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agenda DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE agenda CHANGE ID_PROFISSIONAL ID_PROFISSIONAL INT NOT NULL COMMENT \'Identificador do profissional\', CHANGE ID_USUARIO ID_USUARIO INT DEFAULT NULL COMMENT \'Indentificador do usuário.\'');
        $this->addSql('ALTER TABLE agenda ADD PRIMARY KEY (ID_CLIENTE, ID_PROFISSIONAL, ID_SERVICO)');
        $this->addSql('ALTER TABLE profissional CHANGE ID_USUARIO ID_USUARIO INT DEFAULT NULL COMMENT \'Indentificador do usuário.\'');
        $this->addSql('ALTER TABLE servico CHANGE ID_USUARIO ID_USUARIO INT DEFAULT NULL COMMENT \'Indentificador do usuário.\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agenda DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE agenda CHANGE ID_PROFISSIONAL ID_PROFISSIONAL INT NOT NULL, CHANGE ID_USUARIO ID_USUARIO INT NOT NULL COMMENT \'Indentificador do usuário.\'');
        $this->addSql('ALTER TABLE agenda ADD PRIMARY KEY (ID_CLIENTE, ID_SERVICO, ID_PROFISSIONAL)');
        $this->addSql('ALTER TABLE profissional CHANGE ID_USUARIO ID_USUARIO INT NOT NULL COMMENT \'Indentificador do usuário.\'');
        $this->addSql('ALTER TABLE servico CHANGE ID_USUARIO ID_USUARIO INT NOT NULL COMMENT \'Indentificador do usuário.\'');
    }
}
