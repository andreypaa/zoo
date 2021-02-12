<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212104935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, cell_id INT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, INDEX IDX_6AAB231FCB39D93A (cell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cell (id INT AUTO_INCREMENT NOT NULL, zoo_id INT NOT NULL, animal_type SMALLINT NOT NULL, INDEX IDX_CB8787E2FA5C94EF (zoo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zoo (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FCB39D93A FOREIGN KEY (cell_id) REFERENCES cell (id)');
        $this->addSql('ALTER TABLE cell ADD CONSTRAINT FK_CB8787E2FA5C94EF FOREIGN KEY (zoo_id) REFERENCES zoo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FCB39D93A');
        $this->addSql('ALTER TABLE cell DROP FOREIGN KEY FK_CB8787E2FA5C94EF');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE cell');
        $this->addSql('DROP TABLE zoo');
    }
}
