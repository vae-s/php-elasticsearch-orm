<?php

namespace Vae\PhpElasticsearchOrm\Laravel;

use Illuminate\Support\ServiceProvider;
use Vae\PhpElasticsearchOrm\Builder;
use Vae\PhpElasticsearchOrm\Factory;

class OrmProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $config = $this->config();
        $this->app->singleton(Builder::class, function ($app) use ($config) {
            return Factory::builder($config);
        });
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function config()
    {
        return $this->app->make('config')->get('elasticsearch');
    }
}
