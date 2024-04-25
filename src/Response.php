<?php

namespace App;

class Response {
    const layoutPath = "../layout/";
    const filePath = "../views/";
    private ?string $pageTitle = null;

    public function render($page,array $params = []) : void {
        foreach($params  as $key => $value){
            $$key = $value;
        }
        $pageTitle = $this->pageTitle;
        require self::layoutPath ."header.php";
        require self::filePath . $page . ".php";
        require self::layoutPath . "footer.php";
    }
    public function redirect(string $page) : void {
        header("Location: /" . $page);
        exit();
    }

    public function setPageTitle(string $pageTitle){
        $this->pageTitle = $pageTitle;
    }
}