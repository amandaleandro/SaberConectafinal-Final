<?php
// =============================================
// Classe base Controller
// =============================================
class Controller {

    protected function view($view, $data = [], $layout = true) {
        extract($data, EXTR_SKIP);
        $file = __DIR__ . "/../views/{$view}.php";

        try {
            if (file_exists($file)) {
            
                if ($layout) {
                    include __DIR__ . "/../views/partials/header.php";
                }

               
                include $file;

              
                if ($layout) {
                    include __DIR__ . "/../views/partials/footer.php";
                }
            } else {
                http_response_code(404);
                $this->renderError(404, [
                    'view' => $view,
                    'file' => $file
                ]);
            }
        } catch (Throwable $e) {
            http_response_code(500);
            $this->renderError(500, [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString()
            ]);
        }
    }
    private function renderError($code, $context = []) {
        $errorFile = __DIR__ . "/../views/errors/{$code}.php";

        if (file_exists($errorFile)) {
            extract($context, EXTR_SKIP);
            include $errorFile;
        } else {
            
            echo "<h1>Erro {$code}</h1>";
            if (!empty($context)) {
                echo "<pre>" . htmlspecialchars(print_r($context, true)) . "</pre>";
            }
        }
    }
}
