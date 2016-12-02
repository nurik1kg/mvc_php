<?php

class Router
{ 
    
    private $routes;
    
    public function __construct()
    {
        $routesPatch = ROOT.'/config/routes.php';
        $this->routes = include($routesPatch);
    }
    
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])) // urldi aluu
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function run()
    {
        //print_r($this->routes); //массивди коруу
        //echo('Class Router, method run');
        $uri = $this->getURI();
        //echo '<br>'.$uri;
        foreach ($this->routes as $uriPattern => $path){
            
            // sravnenie $uriPattern i uri
            if (preg_match("~$uriPattern~", $uri ))
            {
                
                //echo $uri.'<br>';
                //echo $path.'<br>';
                // получаем внетренный путь из внешного согласно правилую
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //echo $internalRoute;
                // Opradelit kakoy kontroller
                // i action obrabatyvaut zapros
                
                $segments = explode('/', $internalRoute);
                
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;
                //print_r($parameters);
                
                // Podkluchit fail klassa-kontrollera
                $controllerFile = 'controllers/'.
                    $controllerName.'.php';
                    
                if (file_exists($controllerFile))
                {
                    include_once($controllerFile);
                }
                
                // Sozdat obekt, vyzvat method (t.e. action)
                $controllerObject = new $controllerName;
                
                //$result = $controllerObject->$actionName($parameters);
                $result = call_user_func_array(array($controllerObject, $actionName),$parameters);
                if ($result != null)
                {
                    break;
                }
            }
        }
    }
}