<?php

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernal extends HttpKernel
{
    /**
     * The application's routes.
     *
     * @var array
     */
    protected $routes = [
        'web' => __DIR__.'/routes/web.php',
        'api' => __DIR__.'/routes/api.php',
    ];

    /**
     * The application's middleware.
     *
     * @var array
     */
    protected $middleware = [
        // Core Middleware
        Illuminate\Session\Middleware\StartSession::class,
        Illuminate\View\Middleware\ShareErrors::class,
        Illuminate\Routing\Middleware\ValidateSignature::class,
        Illuminate\Routing\Middleware\ThrottleRequests::class,
        Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

        // Laravel Middleware
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Auth\Middleware\Authenticate::class,
        \Illuminate\Auth\Middleware\Authorize::class,
        \Illuminate\Auth\Middleware\SetUser::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

        // Your Custom Middleware
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => [
            \App\Http\Middleware\Authenticate::class,
            \Illuminate\Auth\Middleware\SetUser::class,
        ],
        'auth.basic' => \Illuminate\Auth\Middleware\BasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];

    /**
     * The application's service providers.
     *
     * @var array
     */
    protected $providers = [
        // Laravel Core Service Providers
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Auth\CacheServiceProvider::class,
        Illuminate\Auth\Codes\ServiceProvider::class,
        Illuminate\Auth\Events\ServiceProvider::class,
        Illuminate\Auth\PasswordBrokerServiceProvider::class,
        Illuminate\Auth\SessionGuardServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Cache\RateLimitingServiceProvider::class,
        Illuminate\Caching\FileCacheServiceProvider::class,
        Illuminate\Caching\MemcachedServiceProvider::class,
        Illuminate\Caching\RedisServiceProvider::class,
        Illuminate\Chronos\ServiceProvider::class,
        Illuminate\Collections\CollectionsServiceProvider::class,
        Illuminate\Console\ArtisanServiceProvider::class,
        Illuminate\Console\SchedulingServiceProvider::class,
        Illuminate\Contracts\Events\ServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Database\MigrationServiceProvider::class,
        Illuminate\Database\Query\BuilderServiceProvider::class,
        Illuminate\Database\Eloquent\ModelServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Events\EventServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\AggregateServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Foundation\Providers\FastScheduleServiceProvider::class,
        Illuminate\Foundation\Providers\LaravelServiceProvider::class,
        Illuminate\Foundation\Providers\RouteManifestServiceProvider::class,
        Illuminate\Foundation\Providers\ServerServiceProvider::class,
        Illuminate\Foundation\Providers\SessionServiceProvider::class,
        Illuminate\Foundation\Providers\StorageServiceProvider::class,
        Illuminate\Foundation\Providers\ViewServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Http\Middleware\Session\MiddlewareServiceProvider::class,
        Illuminate\Lang\LangServiceProvider::class,
        Illuminate\Log\LogServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Mail\MailableServiceProvider::class,
        Illuminate\Mail\NotificationsServiceProvider::class,
        Illuminate\Notifications\ChannelManagerServiceProvider::class
    ];

};