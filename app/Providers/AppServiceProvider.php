<?php

namespace App\Providers;

use App\DataTransferObjects\Factories\UserStoreDTOFactory;
use App\DataTransferObjects\Factories\UserStoreDTOFactoryInterface;
use App\Http\Resources\Factories\UserResourceFactory;
use App\Http\Resources\Factories\UserResourceFactoryInterface;
use App\Managers\UserManager;
use App\Managers\UserManagerInterface;
use App\Models\Factories\UserModelFactory;
use App\Models\Factories\UserModelFactoryInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserStoreDTOFactoryInterface::class,
            function (Container $container) {
                return new UserStoreDTOFactory();
            }
        );

        $this->app->bind(
            UserManagerInterface::class,
            function (Container $container) {
                return new UserManager(
                    $container->get(LoggerInterface::class),
                    $container->get(UserModelFactoryInterface::class),
                    $container->get(UserResourceFactoryInterface::class),
                );
            }
        );

        $this->app->bind(
            UserResourceFactoryInterface::class,
            function (Container $container) {
                return new UserResourceFactory();
            }
        );

        $this->app->bind(
            UserModelFactoryInterface::class,
            function (Container $container) {
                return new UserModelFactory(
                    $container->get(HashManager::class)
                );
            }
        );
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
