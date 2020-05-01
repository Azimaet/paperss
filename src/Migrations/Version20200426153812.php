<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426153812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_board (source_id INT NOT NULL, board_id INT NOT NULL, INDEX IDX_C15EF078953C1C61 (source_id), INDEX IDX_C15EF078E7EC5785 (board_id), PRIMARY KEY(source_id, board_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE source_board ADD CONSTRAINT FK_C15EF078953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source_board ADD CONSTRAINT FK_C15EF078E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE source_board DROP FOREIGN KEY FK_C15EF078953C1C61');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE source_board');
    }
}
