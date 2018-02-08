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
    private static $console;

    /**
     * @var Filesystem
     */
    private static $filesystem;
    /**
     * @var string
     */
    private static $host = 'collabmed.net';
    /**
     * @var string
     */
    private static $folder;
    private static $the_file;
    private static $upload_to;


    public static function init(RunSync $console)
    {
        static::$console = $console;
        self::setFileSystem();
        static::$folder = config('laravel-backup.backup.name') . '/';
        return new static;
    }

    /**
     * @return Filesystem
     */
    private static function setFileSystem()
    {
        $adapter = new SftpAdapter([
            'host' => 'collabmed.net',
            'port' => 22,
            'username' => 'root',
            'password' => 'new23west',
//            'privateKey' => '~/.ssh/id_rsa',
            'root' => '/var/www/backups/',
            'timeout' => 10,
            'directoryPerm' => 0755
        ]);
        static::$filesystem = new Filesystem($adapter);
    }

    /**
     * Retrieve last database dump
     * @return mixed
     */
    private static function last_database_dump()
    {
        $list = Storage::allFiles(self::$folder);
        end($list);
        $last = prev($list);
        self::$the_file = $last;
        self::$upload_to = $last;
        return true;
    }

    /**
     * @return bool
     */
    private static function is_online()
    {
        return checkdnsrr(self::$host);
    }

    /**
     * Upload to the server
     */
    public static function upload_to_remote()
    {
        if (!self::is_online()) {
            self::$console->error('You are offline');
            return false; //probably need to notify
        }
        if (!self::last_database_dump()) {
            return false;
        }
        self::$console->info("File path: ==> " . self::$the_file);
        self::$console->info("Storage path on server: ==> " . self::$upload_to);
        return self::$filesystem->put(self::$upload_to, Storage::get(self::$the_file));
    }

    /**
     * @param $commands
     * @return bool
     */
    public static function importSql()
    {
        $files = glob('/var/www/backups/' . self::$folder . '*.zip');
        $files = array_combine($files, array_map("filemtime", $files));
        arsort($files);
        $latest_file = key($files);
        $unzip = 'unzip -p ' . $latest_file;
        $command_string = "mysql -u " . env('DB_USERNAME') . " -p" . env('DB_PASSWORD') . " " . env('DB_DATABASE');
        $piped = $unzip . '|' . $command_string;
        $x = \exec($piped);
        dd(get_defined_vars());
        $filename = env('DB_DATABASE') . '.sql';
        $path = '/var/www/backups/' . self::$folder . $filename;
        dd($path);
        self::$console->info('File path: ==> ' . $path);
        self::$console->info('Command ==> ' . $command_string);
        \exec($command_string);
        return true;
    }

    public static function runSync($type = 'local')
    {
        if ($type === 'local') {
            self::$console->warn('Trying to upload.');
            $result = self::upload_to_remote();
        } else {
            self::$console->warn('Trying to import.');
            $result = $result = self::importSql();
        }
        if ($result)
            self::$console->info('Okay! Nice');
        else
            self::$console->error('Failed..... ');
    }
}