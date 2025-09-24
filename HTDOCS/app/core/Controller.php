<?php
class Controller {
    protected function view($view, $data = [], $layout = true) {
        
        extract($data, EXTR_SKIP);

        $file = __DIR__ . "/../views/$view.php";

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
            include __DIR__ . "/../views/errors/404.php";
        }
    }
}
