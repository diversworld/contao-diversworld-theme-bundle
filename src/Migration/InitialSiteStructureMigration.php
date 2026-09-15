<?php

declare(strict_types=1);

namespace Diversworld\ContaoDiversworldThemeBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;
use RuntimeException;

class InitialSiteStructureMigration extends AbstractMigration
{
    private const TABLES = [
        'tl_article',
        'tl_calendar',
        'tl_calendar_events',
        'tl_comments',
        'tl_content',
        'tl_faq',
        'tl_faq_category',
        'tl_files',
        'tl_form',
        'tl_form_field',
        'tl_image_size',
        'tl_layout',
        'tl_module',
        'tl_news',
        'tl_news_archive',
        'tl_newsletter',
        'tl_page',
        'tl_theme',
    ];

    public function __construct(private readonly Connection $connection)
    {
    }

    public function getName(): string
    {
        return 'Install Diversworld Theme site structure';
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(self::TABLES)) {
            return false;
        }

        foreach (self::TABLES as $table) {
            if ((int) $this->connection->fetchOne(sprintf('SELECT COUNT(*) FROM %s', $table)) > 0) {
                return false;
            }
        }

        return true;
    }

    public function run(): MigrationResult
    {
        $blueprint = dirname(__DIR__, 2).'/contao/sql/diversworld.sql.gz';

        if (!is_readable($blueprint) || false === ($stream = gzopen($blueprint, 'rb'))) {
            throw new RuntimeException('The Diversworld blueprint data file is not readable.');
        }

        try {
            $this->connection->transactional(function () use ($stream): void {
                $buffer = '';

                while (false !== ($line = gzgets($stream))) {
                    $trimmedLine = trim($line);

                    // Skip empty lines and dump comments; they never contain executable SQL.
                    if ('' === $trimmedLine || str_starts_with($trimmedLine, '--') || str_starts_with($trimmedLine, '#')) {
                        continue;
                    }

                    $buffer .= $line;

                    // Statements can span multiple lines (e.g. CREATE TABLE); only execute
                    // once a full statement, terminated by a semicolon, has been buffered.
                    if (str_ends_with($trimmedLine, ';')) {
                        $statement = trim($buffer);
                        $buffer = '';

                        if ('' !== $statement) {
                            $this->connection->executeStatement($statement);
                        }
                    }
                }

                if ('' !== trim($buffer)) {
                    $this->connection->executeStatement(trim($buffer));
                }
            });
        } finally {
            gzclose($stream);
        }

        return $this->createResult(true, 'Diversworld site structure and demo content were installed.');
    }
}