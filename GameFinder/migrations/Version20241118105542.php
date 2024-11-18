<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118105542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE games_genres (games_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_6AC30AA397FFC673 (games_id), INDEX IDX_6AC30AA34296D31F (genre_id), PRIMARY KEY(games_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games_genres ADD CONSTRAINT FK_6AC30AA397FFC673 FOREIGN KEY (games_id) REFERENCES games (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games_genres ADD CONSTRAINT FK_6AC30AA34296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games_genres DROP FOREIGN KEY FK_6AC30AA397FFC673');
        $this->addSql('ALTER TABLE games_genres DROP FOREIGN KEY FK_6AC30AA34296D31F');
        $this->addSql('DROP TABLE games_genres');
        $this->addSql('DROP TABLE genre');
    }
}
