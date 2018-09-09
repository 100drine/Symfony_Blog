<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906113547 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AE85F12B8');
        $this->addSql('DROP INDEX IDX_5F9E962AE85F12B8 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE post_id_id post_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A4B89032C ON comments (post_id)');
        $this->addSql('ALTER TABLE post CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4B89032C');
        $this->addSql('DROP INDEX IDX_5F9E962A4B89032C ON comments');
        $this->addSql('ALTER TABLE comments CHANGE post_id post_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AE85F12B8 FOREIGN KEY (post_id_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AE85F12B8 ON comments (post_id_id)');
        $this->addSql('ALTER TABLE post CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
