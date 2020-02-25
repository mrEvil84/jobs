<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use JobsApp\Jobs\Application\JobsService;
use JobsApp\Jobs\Domain\JobsRepository;
use JobsApp\Jobs\Infrastructure\JobsDbRepository;
use JobsApp\Jobs\Infrastructure\JobsReadModelDbRepository;
use JobsApp\Jobs\ReadModel\JobsReadModel;
use JobsApp\Jobs\ReadModel\JobsReadModelRepository;

class JobsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JobsReadModel::class, function () {
            return new JobsReadModel(
                resolve(JobsReadModelRepository::class)
            );
        });

        $this->app->bind(JobsReadModelRepository::class, function () {
            return new JobsReadModelDbRepository(
                DB::connection()
            );
        });

        $this->app->bind(JobsRepository::class, function () {
            return new JobsDbRepository(
                DB::connection()
            );
        });

        $this->app->bind(JobsService::class, function () {
            return new JobsService(
                resolve(JobsRepository::class)
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
