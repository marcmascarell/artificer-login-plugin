<?php namespace Mascame\Artificer;


use Mascame\Artificer\Assets\AssetsManagerInterface;
use Mascame\Artificer\Extension\ResourceCollector;
use Mascame\Artificer\Plugin\AbstractPlugin;

use Closure;
use Auth;

class LoginPlugin extends AbstractPlugin {

    /**
     * @var string
     */
    public $name = 'Login plugin';

    /**
     * @var string
     */
    public $thumbnail = ''; // url

    /**
     * @var string
     */
    public $slug = 'artificer-login';

    /**
     * Extension config is not available until boot
     *
     * @param ResourceCollector $collector
     * @return ResourceCollector
     */
    public function resources(ResourceCollector $collector) {
        $collector->loadMigrationsFrom(__DIR__.'/../database/migrations/');

        $collector->loadViewsFrom(__DIR__.'/../resources/views', $this->slug);

        $collector->publishes([__DIR__.'/../config/' => $this->getConfigPath()]);

        return $collector;
    }

    /**
     * @param AssetsManagerInterface $manager
     */
    public function assets(AssetsManagerInterface $manager)
    {
        $manager->add([
            'font-awesome-cdn',
            'bootstrap-css-cdn'
        ]);
    }

    /**
     * This will be called if the plugin is installed
     */
    public function boot()
    {
        \App::make('router')->middlewareGroup('artificer-auth', [LoginPlugin::class]);

        $this->mergeRecursiveAuthConfig();
    }

    /**
     * This will be called when plugin is installed
     */
    public function install() {
        // Seed
        $result = ArtificerUser::find(1);

        if (! $result) {
            ArtificerUser::create([
                'name' => 'Demo User',
                'email' => 'artificer@artificer.at', // fake email
                'username' => 'artificer',
                'password' => \Hash::make('artificer'),
                'role' => 'admin',
            ]);
        }
    }

    /**
     * Middleware 'artificer-auth'. Handles an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest(\URL::route('admin.login.show'));
        }

        return $next($request);
    }

    protected function mergeRecursiveAuthConfig() {
        config([
            'auth' => array_merge_recursive(
                config('auth'),
                $this->getConfig('auth')
            )
        ]);
    }
}