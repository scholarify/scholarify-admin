<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MongoDB\Client;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\MongoDbSessionHandler;

class MongoDBSessionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app['session']->extend('mongodb', function ($app) {
            // Récupérer les paramètres de connexion depuis la configuration
            $connection = $app['config']['session.connection'] ?? 'mongodb';
            $table = $app['config']['session.table'] ?? 'sessions';

            // Récupérer les paramètres de la connexion MongoDB depuis config/database.php
            $mongoConfig = $app['config']['database.connections'][$connection];

            // Construire l'URI de connexion pour MongoDB\Client
            $uri = $mongoConfig['dsn'] ?? sprintf(
                'mongodb://%s:%s@%s:%s/%s',
                $mongoConfig['username'],
                $mongoConfig['password'],
                $mongoConfig['host'],
                $mongoConfig['port'],
                $mongoConfig['database']
            );

            // Ajouter les options supplémentaires si elles existent
            $uriOptions = $mongoConfig['options'] ?? [];
            if (!empty($uriOptions)) {
                $uri .= '?' . http_build_query($uriOptions);
            }

            // Créer une instance de MongoDB\Client
            $mongoClient = new Client($uri);
            // Définir les options pour MongoDbSessionHandler
            $options = [
                'database' => $mongoConfig['database'], // Nom de la base de données (par exemple, 'Scolarify')
                'collection' => $table, // Nom de la collection (par exemple, 'sessions')
            ];

            // Retourner le handler de session
            return new MongoDbSessionHandler($mongoClient, $options);
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
