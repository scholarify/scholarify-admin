<?php

namespace App\Session;

use MongoDB\Client as MongoDBClient;
use MongoDB\Collection;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\AbstractSessionHandler;

class CustomMongoDbSessionHandler extends AbstractSessionHandler
{
    protected $mongoClient;
    protected $collection;
    protected $sessionName;

    public function __construct(MongoDBClient $mongoClient, array $options)
    {
        $this->mongoClient = $mongoClient;
        $this->collection = $mongoClient->selectDatabase($options['database'])->selectCollection($options['collection']);
    }

    public function open($savePath, $sessionName): bool
    {
        $this->sessionName = $sessionName;

        // Appeler la méthode parent::open()
        if (!parent::open($savePath, $sessionName)) {
            return false;
        }

        return true;
    }

    public function close(): bool
    {
        return true;
    }

    public function read($sessionId): string
    {
        $session = $this->collection->findOne(['_id' => $sessionId]);

        if ($session) {
            return $session['payload'] ?? '';
        }

        return '';
    }

    public function write($sessionId, $data): bool
    {
        $this->collection->updateOne(
            ['_id' => $sessionId],
            [
                '$set' => [
                    'payload' => $data,
                    'last_activity' => time(),
                ],
            ],
            ['upsert' => true]
        );

        return true;
    }

    public function destroy($sessionId): bool
    {
        $this->collection->deleteOne(['_id' => $sessionId]);
        return true;
    }

    protected function doRead($sessionId): string
    {
        $session = $this->collection->findOne(['_id' => $sessionId]);

        return $session['payload'] ?? '';
    }

    protected function doWrite($sessionId, $data): bool
    {
        $this->collection->updateOne(
            ['_id' => $sessionId],
            [
                '$set' => [
                    'payload' => $data,
                    'last_activity' => time(),
                ],
            ],
            ['upsert' => true]
        );

        return true;
    }

    protected function doDestroy($sessionId): bool
    {
        $this->collection->deleteOne(['_id' => $sessionId]);
        return true;
    }

    public function updateTimestamp($sessionId, $data): bool
    {
        $this->collection->updateOne(
            ['_id' => $sessionId],
            [
                '$set' => [
                    'last_activity' => time(),
                ],
            ]
        );

        return true;
    }
    public function gc($maxlifetime): int|false
    {
        $expiration = time() - $maxlifetime;
        $result = $this->collection->deleteMany(['last_activity' => ['$lt' => $expiration]]);

        return $result->getDeletedCount();
    }
}
