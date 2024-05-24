<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515175450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, street VARCHAR(30) NOT NULL, city VARCHAR(30) NOT NULL, state VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE books (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(100) NOT NULL, author VARCHAR(100) NOT NULL, publishÂ¿Âed_date DATETIME NOT NULL, isbn INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, users_id INTEGER NOT NULL, user_id INTEGER NOT NULL, book_id INTEGER NOT NULL, review_content VARCHAR(255) NOT NULL, published_date DATETIME NOT NULL, CONSTRAINT FK_6970EB0F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6970EB0F67B3B43D ON reviews (users_id)');
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, addresses_id INTEGER NOT NULL, username VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, CONSTRAINT FK_1483A5E95713BC80 FOREIGN KEY (addresses_id) REFERENCES addresses (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E95713BC80 ON users (addresses_id)');
        $this->addSql('CREATE TABLE users_books (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, book_id INTEGER NOT NULL, checkout_date DATETIME NOT NULL, return_date DATETIME NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_books');
    }
}
