<?php

namespace Ignite\Core\Library;


use Ignite\Core\Console\RunSync;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

/**
 * Class Sync
 * @package Ignite\Core\Library
 */
class Sync
{
    /**
     * @var RunSync
     */
    private $console;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var string
     */
    private $host = 'collabmed.net';
    /**
     * @var string
     */
    private $folder;
    /**
     * @var string
     */
    private $the_file;

    /**
     * Sync constructor.
     * @param RunSync $console
     */
    public function __construct($console)
    {
        $this->console = $console;
        $this->setFileSystem();
        $this->folder = config('laravel-backup.backup.name') . '/';
    }

    /**
     * @return Filesystem
     */
    private function setFileSystem()
    {
        $adapter = new SftpAdapter([
            'host' => 'collabmed.net',
            'port' => 22,
            'username' => 'root',
            'password' => 'new23west',
            // 'privateKey' => 'path/to/or/contents/of/privatekey',
            'root' => '/var/www/backups/',
            'timeout' => 10,
            'directoryPerm' => 0755
        ]);
        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * Retrieve last database dump
     * @return mixed
     */
    private function last_database_dump()
    {
        $list = Storage::allFiles($this->folder);
        end($list);
        $last = prev($list);
        $path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix(); // . $folder;
        $file = $path . $last;
        $zip = new \ZipArchive;
        if ($zip->open($file) === TRUE) {
            $zip->extractTo($path . $this->folder);
            $zip->close();
            $this->the_file = $this->folder . 'db-dumps/mysql-' . env('DB_DATABASE') . '.sql';
            return true; //$folder . 'clinic_v2.sql';
        }
        return false;
    }

    /**
     * @return bool
     */
    private function is_online()
    {
        return checkdnsrr($this->host);
    }

    /**
     * Upload to the server
     */
    public function upload_to_remote()
    {
        $filename = env('DB_DATABASE') . '.sql';
        if (!$this->is_online()) {
            $this->console->warn('You are offline');
            return false; //probably need to notify
        }
        $ll = $this->folder . $filename;
        $exists = Storage::disk()->exists($ll);
        if ($exists) {
            $this->console->info('Delete existing file ' . $ll);
            Storage::delete($ll);
        }
        if (!$this->last_database_dump()) {
            return false;
        }
        $this->console->info("File path: ==> " . $this->the_file);
        $this->console->info("Storage path on server: ==> " . $ll);
        return $this->filesystem->put($ll, Storage::get($this->the_file));
    }

    /**
     * @param $commands
     * @return bool
     */
    public function importSql()
    {
        $filename = env('DB_DATABASE') . '.sql';
        $path = '/var/www/backups/' . $this->folder . $filename;
        $this->console->info('File path: ==> ' . $path);
        $command_string = "mysql -u " . env('DB_USERNAME') . " -p" . env('DB_PASSWORD') . " " . env('DB_DATABASE') . " < $path";
        $this->console->info('Command ==> ' . $command_string);
        \exec($command_string);
        return true;
    }

    public function runSync($type = 'local')
    {
        if ($type === 'local') {
            $this->console->warn('Trying to upload.');
            $result = $this->upload_to_remote();
        } else {
            $this->console->warn('Trying to import.');
            $result = $this->importSql();
        }
        if ($result)
            $this->console->info('Okay! Nice');
        else
            $this->console->error('Failed..... ');
    }
}