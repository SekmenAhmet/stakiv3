<?php

namespace App;

class Response {
    const layoutPath = "../layout/";
    const filePath = "../views/";
    public function render($page){
        require self::layoutPath ."header.php";
        require self::filePath . $page . ".php";
        require self::layoutPath . "footer.php";
    }
    public function redirect(string $page){
        header("Location: /" . $page);
        exit();
    }
}