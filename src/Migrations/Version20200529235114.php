<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529235114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE source_board');
        $this->addSql('ALTER TABLE source ADD board_id INT NOT NULL');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F73E7EC5785 ON source (board_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE source_board (source_id INT NOT NULL, board_id INT NOT NULL, INDEX IDX_C15EF078953C1C61 (source_id), INDEX IDX_C15EF078E7EC5785 (board_id), PRIMARY KEY(source_id, board_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE source_board ADD CONSTRAINT FK_C15EF078953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source_board ADD CONSTRAINT FK_C15EF078E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F73E7EC5785');
        $this->addSql('DROP INDEX IDX_5F8A7F73E7EC5785 ON source');
        $this->addSql('ALTER TABLE source DROP board_id');
    }
}
