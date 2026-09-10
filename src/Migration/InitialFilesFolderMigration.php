<?php

declare(strict_types=1);

namespace Diversworld\ContaoDiversworldThemeBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class InitialFilesFolderMigration extends AbstractMigration
{
    public function __construct(
        private readonly Connection $connection,
        private readonly Filesystem $filesystem,
        private readonly ParameterBagInterface $parameters,
    ) {
    }

    public function getName(): string
    {
        return 'Install Diversworld Theme custom SCSS files';
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['tl_files', 'tl_layout'])) {
            return false;
        }

        $sourceDirectory = dirname(__DIR__, 2).'/contao/files/diversworld';
        $filesDirectory = $this->getFilesDirectory();

        foreach ($this->getFiles($sourceDirectory) as $file) {
            if (!$this->filesystem->exists($filesDirectory.'/'.$file)) {
                return true;
            }
        }

        return false;
    }

    public function run(): MigrationResult
    {
        $sourceDirectory = dirname(__DIR__, 2).'/contao/files/diversworld';
        $filesDirectory = $this->getFilesDirectory();

        foreach ($this->getFiles($sourceDirectory) as $file) {
            $source = $sourceDirectory.'/'.$file;
            $target = $filesDirectory.'/'.$file;

            if (!$this->filesystem->exists($target)) {
                $this->filesystem->copy($source, $target);
            }
        }

        return $this->createResult(true, 'Diversworld custom SCSS files were installed.');
    }

    private function getFilesDirectory(): string
    {
        return rtrim((string) $this->parameters->get('kernel.project_dir'), '/')
            .'/'.trim((string) $this->parameters->get('contao.upload_path'), '/')
            .'/diversworld';
    }

    /**
     * @return list<string>
     */
    private function getFiles(string $directory): array
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
        );
        $files = [];

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $files[] = substr($file->getPathname(), strlen($directory) + 1);
            }
        }

        return $files;
    }
}
