<?php

namespace app;

class Router
{
    public array $get_routes = [];
    public array $post_routes = [];
    public Database $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function get($url, $fn)
    {
        $this->get_routes[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->post_routes[$url] = $fn;
    }

    public function resolve()
    {

        $currentUrl = $_SERVER["PATH_INFO"] ?? '/';
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method === "GET") {
            $fn = $this->get_routes[$currentUrl] ?? null;
        } else {
            $fn = $this->post_routes[$currentUrl] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Page not found";
        }
    }
    public function RenderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . "/views/_layout.php";
    }
}
