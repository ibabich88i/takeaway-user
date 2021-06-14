<?php

namespace App\Providers;

use App\DataTransferObjects\Factories\ResetPasswordDTOFactory;
use App\DataTransferObjects\Factories\ResetPasswordDTOFactoryInterface;
use App\DataTransferObjects\Factories\UserStoreDTOFactory;
use App\DataTransferObjects\Factories\UserStoreDTOFactoryInterface;
use App\Http\Resources\Factories\PasswordResetResourceFactory;
use App\Http\Resources\Factories\PasswordResetResourceFactoryInterface;
use App\Http\Resources\Factories\UserResourceFactory;
use App\Http\Resources\Factories\UserResourceFactoryInterface;
use App\Managers\PasswordResetManager;
use App\Managers\PasswordResetManagerInterface;
use App\Managers\UserManager;
use App\Managers\UserManagerInterface;
use App\Models\Factories\PasswordResetModelFactory;
use App\Models\Factories\PasswordResetModelFactoryInterface;
use App\Models\Factories\UserModelFactory;
use App\Models\Factories\UserModelFactoryInterface;
use App\Models\PasswordResetModel;
use App\Models\UserModel;
use App\Repositories\PasswordResetRepository;
use App\Repositories\PasswordResetRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
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

        $this->app->bind(
            PasswordResetResourceFactoryInterface::class,
            function (Container $container) {
                return new PasswordResetResourceFactory();
            }
        );

        $this->app->bind(
            PasswordResetModelFactoryInterface::class,
            function (Container $container) {
                return new PasswordResetModelFactory();
            }
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            function (Container $container) {
                return new UserRepository($container->get(UserModel::class));
            }
        );

        $this->app->bind(
            PasswordResetRepositoryInterface::class,
            function (Container $container) {
                return new PasswordResetRepository($container->get(PasswordResetModel::class));
            }
        );

        $this->app->bind(
            PasswordResetManagerInterface::class,
            function (Container $container) {
                return new PasswordResetManager(
                    $container->get(PasswordResetModelFactoryInterface::class),
                    $container->get(PasswordResetResourceFactoryInterface::class),
                    $container->get(UserRepositoryInterface::class),
                    $container->get(PasswordResetRepositoryInterface::class),
                    $container->get(HashManager::class),
                    $container->get(LoggerInterface::class),
                );
            }
        );

        $this->app->bind(
            ResetPasswordDTOFactoryInterface::class,
            function (Container $container) {
                return new ResetPasswordDTOFactory();
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
