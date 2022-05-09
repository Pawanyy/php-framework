<?php

namespace app\core;

class Router{

    public Request $request;
    protected array $routes = [];

    
    public function __construct(\app\core\Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            $this->NotFound();
        }

        if( is_string($callback)){
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $file_location = Application::$ROOT_DIR . "/views/$view.php";
        
        if(file_exists($file_location)){
            
            include_once $file_location;

        } else{

            $this->NotFound();

        }
    }

    public function NotFound()
    {
        http_response_code(404);
        echo "Not Found!!!";
        exit;
    }

}
