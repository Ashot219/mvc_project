<?php

/**
 * Класс Router
 * Компонент для работы с маршрутами
 */
class Router
{

    /**
     * Свойство для хранения массива роутов
     * @var array
     */
    private $routes;

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Путь к файлу с роутами
        $routesPath = ROOT . '/config/routes.php';

        // Получаем роуты из файла
        $this->routes = include($routesPath);
    }

    /**
     * Возвращает строку запроса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
//            $uri = str_replace("/pricing/", "", $_SERVER['REQUEST_URI']);
//            return trim($uri, '/');
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Метод для обработки запроса
     */
    public function run()
    {
        // Получаем строку запроса
        $uri = $this->getURI();

        if ($uri == '') {
            $uri = 'tasks/index';
        }

        // Проверяем наличие такого запроса в массиве маршрутов (routes.php)
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определить контроллер, action, параметры

                $segments = explode('/', $internalRoute);

                array_shift($segments);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);


                $actionName = 'action' . ucfirst(array_shift($segments));
//                $actionName = 'actionIndex';

                $parameters = $segments;
//                $parameters = [];
                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';



                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                } else {
                    $controllerFile = ROOT . '/controllers/TaskController.php';

                    $controllerName = 'TaskController.php';
                    $actionName = 'actionIndex';
                    $parameters = [];
                    include_once($controllerFile);
                }


                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;

//                $parameters = [];
 $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                // Если метод контроллера успешно вызван, завершаем работу роутера
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
