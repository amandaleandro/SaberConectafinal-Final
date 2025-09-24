<?php
class Router {
    public function dispatch($route) {
        try {
            if (empty($route)) {
                $route = "site/home";
            }
            [$controllerName, $method] = array_pad(explode("/", $route), 2, null);

            $controllerClass = ucfirst($controllerName) . "Controller";
            $method = $method ?: "index";

            $controllerFile = __DIR__ . "/../controllers/{$controllerClass}.php";

            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();

                    if (method_exists($controller, $method)) {
                        return $controller->$method();
                    } else {
                        return $this->handleError(404, 'method_not_found', [
                            'controller' => $controllerClass,
                            'method'     => $method
                        ]);
                    }
                } else {
                    return $this->handleError(404, 'class_not_found', [
                        'controller' => $controllerClass
                    ]);
                }
            } else {
                return $this->handleError(404, 'controller_not_found', [
                    'controller' => $controllerClass,
                    'file'       => $controllerFile
                ]);
            }
        } catch (Throwable $e) {
            return $this->handleError(500, 'routing_exception', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Encaminha erros para o ErrorController
     */
    private function handleError($code, $type, $context = []) {
        $errorControllerFile = __DIR__ . "/../controllers/ErrorController.php";

        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $errorController = new ErrorController();

            switch ($code) {
                case 404:
                    return $errorController->notFound($context);
                case 403:
                    return $errorController->forbidden($context);
                case 405:
                    return $errorController->custom(405, "Método Não Permitido", "A ação que você tentou executar não é permitida para esta rota.", "Verifique a URL ou volte para a página anterior.");
                case 500:
                    return $errorController->internalError($context);
                case 503:
                    return $errorController->maintenance($context);
                default:
                    return $errorController->custom([
                        'code'       => $code,
                        'title'      => 'Erro no Sistema',
                        'message'    => 'Ocorreu um erro inesperado no sistema.',
                        'context'    => $context
                    ]);
            }
        } else {
            http_response_code($code);
            echo "<h1>{$code} - Erro do Sistema</h1>";
            echo "<p>Tipo: {$type}</p>";
        }
    }

    /**
     * Chamado direto pela classe Database ao falhar
     */
    public static function handleDatabaseError($error) {
        $errorControllerFile = __DIR__ . "/../controllers/ErrorController.php";

        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $errorController = new ErrorController();
            return $errorController->database($error);
        } else {
            http_response_code(500);
            echo "<h1>Erro de Banco de Dados</h1>";
            echo "<p>" . htmlspecialchars($error['message'] ?? 'Erro de conexão com a base de dados.') . "</p>";
        }
    }
}
