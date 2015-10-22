<?php

namespace Mini\config;

use SassCompiler;

class App
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->app->setName("Influencers");

        // and define the engine used for the view @see http://twig.sensiolabs.org
        $this->app->view = new \Slim\Views\Twig();
        $this->app->view->setTemplatesDirectory("../Mini/views");

        // Configs for mode "development" (Slim's default), see the GitHub readme for details on setting the environment
        $this->app->configureMode('development', function() {
            $this->development();
        });

        // Configs for mode "production"
        // $this->app->configureMode('production', function() {
            // $this->production();
        // });
    }

    public function development()
    {
        // pre-application hook, performs stuff before real action happens @see http://docs.slimframework.com/#Hooks
        $this->app->hook('slim.before', function () {

            // SASS-to-CSS compiler @see https://github.com/panique/php-sass
            SassCompiler::run("scss/", "css/");

            // CSS minifier @see https://github.com/matthiasmullie/minify
            // $minifier = new MatthiasMullie\Minify\CSS('css/style.css');
            // $minifier->minify('css/style.css');

            // JS minifier @see https://github.com/matthiasmullie/minify
            // DON'T overwrite your real .js files, always save into a different file
            //$minifier = new MatthiasMullie\Minify\JS('js/application.js');
            //$minifier->minify('js/application.minified.js');
        });

        // Set the configs for development environment
        $this->app->config(array(
            'debug' => true,
            'database' => array(
                'db_host' => 'localhost',
                'db_port' => '3306',
                'db_name' => 'mini',
                'db_user' => 'root',
                'db_pass' => ''
            )
        ));
    }

    public function production()
    {
        // Set the configs for production environment
        $this->app->config(array(
            'debug' => false,
            'database' => array(
                'db_host' => '',
                'db_port' => '',
                'db_name' => '',
                'db_user' => '',
                'db_pass' => ''
            )
        ));
    }

}
