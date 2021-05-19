<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519172834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Guestbook and GuestbookEntry';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE guestbook_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE guestbook_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE guestbook (id INT NOT NULL, owner_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_887041387E3C61F9 ON guestbook (owner_id)');
        $this->addSql('CREATE TABLE guestbook_entry (id INT NOT NULL, author_id INT NOT NULL, guestbook_id INT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A8BA6F71F675F31B ON guestbook_entry (author_id)');
        $this->addSql('CREATE INDEX IDX_A8BA6F71F55E7EE8 ON guestbook_entry (guestbook_id)');
        $this->addSql('ALTER TABLE guestbook ADD CONSTRAINT FK_887041387E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE guestbook_entry ADD CONSTRAINT FK_A8BA6F71F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE guestbook_entry ADD CONSTRAINT FK_A8BA6F71F55E7EE8 FOREIGN KEY (guestbook_id) REFERENCES guestbook (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE guestbook_entry DROP CONSTRAINT FK_A8BA6F71F55E7EE8');
        $this->addSql('DROP SEQUENCE guestbook_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE guestbook_entry_id_seq CASCADE');
        $this->addSql('DROP TABLE guestbook');
        $this->addSql('DROP TABLE guestbook_entry');
    }
}
