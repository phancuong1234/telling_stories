<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(
        //     'App\Repositories\CategoryRepository\CategoryRepositoryInterface',
        //     'App\Repositories\CategoryRepository\CategoryRepository'
        // );

        $repositories = [
            'App\Repositories\CategoryRepository\CategoryRepositoryInterface' => 'App\Repositories\CategoryRepository\CategoryRepository',
            'App\Repositories\UserRepository\UserRepositoryInterface' => 'App\Repositories\UserRepository\UserRepository',
            'App\Repositories\StoryRepository\StoryRepositoryInterface' => 'App\Repositories\StoryRepository\StoryRepository',
             'App\Repositories\AgeRepository\AgeRepositoryInterface' => 'App\Repositories\AgeRepository\AgeRepository',
             'App\Repositories\QuestionRepository\QuestionRepositoryInterface' => 'App\Repositories\QuestionRepository\QuestionRepository',
             'App\Repositories\StoryAgeRepository\StoryAgeRepositoryInterface' => 'App\Repositories\StoryAgeRepository\StoryAgeRepository',
        ];
        foreach ($repositories as $key => $val){
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
