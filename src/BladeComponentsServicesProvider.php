<?php namespace Yocmen\BladeComponents;

use Illuminate\View\ViewServiceProvider;

class BladeComponentsServicesProvider extends ViewServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->bladeDirectives();
    }

    /**
     * Register the view environment.
     *
     * @return void
     */
    public function registerFactory()
    {

        $this->app->singleton('view', function ($app) {
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP or Blade engine.
            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            $env = new BladeComponentsFactory($resolver, $finder, $app['events']);

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $env->setContainer($app);

            $env->share('app', $app);

            return $env;
        });
    }

    private function bladeDirectives()
    {
        \Blade::directive('component', function ($expression) {
            return "<?php \$__env->startComponent{$expression}; ?>";
        });

        \Blade::directive('endcomponent', function ($expression) {
            return '<?php echo $__env->renderComponent(); ?>';
        });

        \Blade::directive('slot', function ($expression) {
            return "<?php \$__env->slot{$expression}; ?>";
        });

        \Blade::directive('endslot', function ($expression) {
            return '<?php $__env->endSlot(); ?>';
        });
    }
}