<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524073224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artisan ADD CONSTRAINT FK_3C600AD312469DE2 FOREIGN KEY (category_id) REFERENCES artisans_job (id)');
        $this->addSql('CREATE INDEX IDX_3C600AD312469DE2 ON artisan (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan DROP FOREIGN KEY FK_3C600AD312469DE2');
        $this->addSql('DROP INDEX IDX_3C600AD312469DE2 ON artisan');
        $this->addSql('ALTER TABLE artisan DROP category_id');
    }
}
