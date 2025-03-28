<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MongoDB\Client as MongoDBClient;
use App\Session\CustomMongoDbSessionHandler;

class MongoDBSessionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app['session']->extend('mongodb', function ($app) {
            logger('MongoDBSessionServiceProvider: Initialisation du driver de session mongodb');

            // Récupérer les paramètres de connexion depuis la configuration
            $connection = $app['config']['session.connection'] ?? 'mongodb';
            $table = $app['config']['session.table'] ?? 'sessions';

            // Récupérer les paramètres de la connexion MongoDB depuis config/database.php
            $mongoConfig = $app['config']['database.connections'][$connection];
            logger('MongoDB Config: ' . json_encode($mongoConfig));

            // Construire l'URI de connexion pour MongoDB\Client
            $uri = $mongoConfig['dsn'] ?? sprintf(
                'mongodb://%s:%s@%s:%s/%s',
                $mongoConfig['username'] ?? '',
                $mongoConfig['password'] ?? '',
                $mongoConfig['host'],
                $mongoConfig['port'],
                $mongoConfig['database']
            );

            // Ajouter les options supplémentaires si elles existent
            $uriOptions = $mongoConfig['options'] ?? [];
            if (!empty($uriOptions)) {
                $uri .= '?' . http_build_query($uriOptions);
            }

            logger('MongoDB URI: ' . $uri);

            // Créer une instance de MongoDB\Client
            try {
                $mongoClient = new MongoDBClient($uri);
                logger('MongoDB Client créé avec succès');
            } catch (\Exception $e) {
                logger('Erreur lors de la création de MongoDB Client: ' . $e->getMessage());
                throw $e;
            }

            // Définir les options pour CustomMongoDbSessionHandler
            $options = [
                'database' => $mongoConfig['database'],
                'collection' => $table,
            ];

            logger('Session Handler Options: ' . json_encode($options));

            // Utiliser la classe personnalisée
            return new CustomMongoDbSessionHandler($mongoClient, $options);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
