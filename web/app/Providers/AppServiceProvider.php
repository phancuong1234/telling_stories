<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $repositories = [
            'App\Repositories\CategoryRepository\CategoryRepositoryInterface' => 'App\Repositories\CategoryRepository\CategoryRepository',
            'App\Repositories\UserRepository\UserRepositoryInterface' => 'App\Repositories\UserRepository\UserRepository',
            'App\Repositories\StoryRepository\StoryRepositoryInterface' => 'App\Repositories\StoryRepository\StoryRepository',
            'App\Repositories\AgeRepository\AgeRepositoryInterface' => 'App\Repositories\AgeRepository\AgeRepository',
            'App\Repositories\QuestionRepository\QuestionRepositoryInterface' => 'App\Repositories\QuestionRepository\QuestionRepository',
            'App\Repositories\StoryAgeRepository\StoryAgeRepositoryInterface' => 'App\Repositories\StoryAgeRepository\StoryAgeRepository',
            'App\Repositories\VideoRepository\VideoRepositoryInterface' => 'App\Repositories\VideoRepository\VideoRepository',
            'App\Repositories\PlaylistRepository\PlaylistRepositoryInterface' => 'App\Repositories\PlaylistRepository\PlaylistRepository',
            'App\Repositories\HistoryRepository\HistoryRepositoryInterface' => 'App\Repositories\HistoryRepository\HistoryRepository',
            'App\Repositories\FavoriteRepository\FavoriteRepositoryInterface' => 'App\Repositories\FavoriteRepository\FavoriteRepository',
            'App\Repositories\VideoUserRepository\VideoUserRepositoryInterface' => 'App\Repositories\VideoUserRepository\VideoUserRepository',
            'App\Repositories\ResultTestRepository\ResultTestRepositoryInterface' => 'App\Repositories\ResultTestRepository\ResultTestRepository',
            'App\Repositories\CommentRepository\CommentRepositoryInterface' => 'App\Repositories\CommentRepository\CommentRepository',
            'App\Repositories\ChartRepository\ChartRepositoryInterface' => 'App\Repositories\ChartRepository\ChartRepository',
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
        URL::forceScheme('https');
    }
}
