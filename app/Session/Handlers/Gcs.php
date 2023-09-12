<?php

namespace App\Session\Handlers;

use CodeIgniter\Session\Handlers\FileHandler;
use Google\Cloud\Core\ExponentialBackoff;
use Google\Cloud\Storage\StorageClient;

class Gcs extends FileHandler
{
    protected $bucketName = 'bss-sandbox-bsswebsite-1'; // Replace with your GCS bucket name

    public function __construct($config)
    {
        parent::__construct($config);

        $this->savePath = "gs://{$this->bucketName}/sessions";

        // Initialize GCS client
        $storage = new StorageClient();
        $this->bucket = $storage->bucket($this->bucketName);
    }

    public function read($sessionID)
    {
        $object = $this->bucket->object($sessionID);

        if ($object->exists()) {
            return (string) $object->downloadAsString();
        }

        return '';
    }

    public function write($sessionID, $sessionData)
    {
        $object = $this->bucket->object($sessionID);
        $object->upload($sessionData);

        return true;
    }
}
