<?php
class Router {
    public function dispatch($route) {
        try {
            $parts = explode("/", trim($route, "/"));

            $controllerName = ucfirst($parts[0] ?? "home") . "Controller";
            $method = $parts[1] ?? "index";
            $params = array_slice($parts, 2);

            $controllerFile = __DIR__ . "/../controllers/{$controllerName}.php";

            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();

                    if (is_callable([$controller, $method])) {
                        return call_user_func_array([$controller, $method], $params);
                    } else {
                        $this->handleError(405, 'method_not_allowed', [
                            'controller' => $controllerName,
                            'method' => $method
                        ]);
                    }
                } else {
                    $this->handleError(404, 'class_not_found', [
                        'controller' => $controllerName
                    ]);
                }
            } else {
                $this->handleError(404, 'controller_not_found', [
                    'controller' => $controllerName,
                    'file' => $controllerFile
                ]);
            }
        } catch (Exception $e) {
            $this->handleError(500, 'routing_exception', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString()
            ]);
        }
    }

    private function handleError($code, $type, $context = []) {
        $errorControllerFile = __DIR__ . "/../controllers/ErrorController.php";

        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $errorController = new ErrorController();

            switch ($code) {
                case 404: return $errorController->notFound($context);
                case 403: return $errorController->forbidden($context);
                case 405: return $errorController->methodNotAllowed($context);
                case 500: return $errorController->internalError($context);
                case 503: return $errorController->maintenance($context);
                default:
                    return $errorController->custom([
                        'code'    => $code,
                        'type'    => $type,
                        'title'   => 'Erro no Sistema',
                        'message' => 'Ocorreu um erro inesperado.',
                        'context' => $context
                    ]);
            }
        } else {
            http_response_code($code);
            echo "<h1>{$code} - Erro do Sistema</h1>";
            echo "<p>Tipo: {$type}</p>";
        }
    }

    public static function handleDatabaseError($error) {
        $errorControllerFile = __DIR__ . "/../controllers/ErrorController.php";

        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $errorController = new ErrorController();
            return $errorController->database($error);
        } else {
            http_response_code(500);
            echo "<h1>Erro de Base de Dados</h1>";
            echo "<p>" . htmlspecialchars($error['message'] ?? 'Erro de conexão.') . "</p>";
        }
    }
}
