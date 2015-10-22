<?php

namespace Mini\routes;

class Routes
{
    use \Mini\helpers\Options;

    public function __construct($app)
    {
        $this->app = $app;
        $this->setup();
    }

    protected $routes = array(
        '/'                 => array('controller' => 'index',            'name' => '@index',          'type' => 'get'),
        '/subpage'          => array('controller' => 'subpage',          'name' => '@subpage',        'type' => 'get'),
        '/subpage/deeper'   => array('controller' => 'subpagedeeper',    'name' => '@subpage-deeper', 'type' => 'get'),
        '/songs'            => array('group' => array(
            '/'                 => array('controller' => 'songsIndex',    'name' => '@songs/index',  'type' => 'get'),
            '/delete/:song_id'  => array('controller' => 'songsDelete',   'name' => '@songs/delete', 'type' => 'get'),
            '/edit/:song_id'    => array('controller' => 'songsEdit',     'name' => '@songs/edit',   'type' => 'get'),
            '/add'              => array('controller' => 'songsAdd',      'name' => '@songs/add',    'type' => 'post'),
            '/update'           => array('controller' => 'songsUpdate',   'name' => '@songs/update', 'type' => 'post'),
            '/search'           => array('controller' => 'songsSearch',   'name' => '@songs/search', 'type' => 'post'),
            '/search'           => array('controller' => 'songsSearch',   'name' => '@songs/search', 'type' => 'get'),
            '/stats'            => array('controller' => 'songsStats',    'name' => '@songs/stats',  'type' => 'get'),
        )),
    );

    protected function setup_route($url, $params)
    {
        extract($params);

        $callback = function($request_params) use ($controller) {
            $namespace = '\Mini\controllers\\'; // __NAMESPACE__ doesn't work out of the box
            $method_name = '::get_instance';
            $method_args = array('app' => $this->app, 'request_params' => $request_params);
            call_user_func($namespace . $controller . $method_name, $method_args);
        };
        $route_type_method = array($this->app, $type);
        $route = call_user_func($route_type_method, $url, $callback);
        $route->name(self::get($params, 'name', $url));
    }

    protected function setup_group($base_url, $routes)
    {
        $this->app->group($base_url, function() use ($routes) {
           foreach ($routes as $url => $params) {
                $this->setup_route($url, $params);
            }
        });
    }

    public function setup()
    {
        foreach ($this->routes as $url => $params) {
            extract($params);
            if (!empty($group)) {
                $this->setup_group($url, $group);
            } else {
                $this->setup_route($url, $params);
            }
        }
    }
}
