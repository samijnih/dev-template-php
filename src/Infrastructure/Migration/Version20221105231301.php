<?php

declare(strict_types=1);

namespace Infrastructure\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221105231301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create saga table.';
    }

    public function up(Schema $schema): void
    {
        $sql = <<<'SQL'
            CREATE TABLE public.saga (
                id UUID PRIMARY KEY,
                type TEXT NOT NULL,
                status INT NOT NULL,
                metadata JSON NOT NULL,
                payload JSON NOT NULL,
                created_at TIMESTAMP WITH TIME ZONE NOT NULL,
                updated_at TIMESTAMP WITH TIME ZONE,
                finished_at TIMESTAMP WITH TIME ZONE
            )
            SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE public.saga');
    }
}
