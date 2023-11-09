<?php

require_once __DIR__ . "/../controllers/recettesController.php";

class SessionManager {
    public static function storeRecettesController(RecettesController $controller) {
        $_SESSION['recettesController'] = serialize($controller);
    }

    public static function retrieveRecettesController() {
        if (isset($_SESSION['recettesController'])) {
            return unserialize($_SESSION['recettesController']);
        } else {
            return new RecettesController();
        }
    }
}