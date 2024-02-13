<?php

    require_once 'app/core/core.php';

    require_once 'lib/database/connection.php';

    require_once 'app/controllers/homeController.php';
    require_once 'app/controllers/errorController.php';
    require_once 'app/controllers/postController.php';
    
    require_once 'app/model/post.php';

    require_once 'vendor/autoload.php';
    
    $template = file_get_contents('app/templates/template.html');

    ob_start();
        $core = new Core;
        $core->start($_GET);
        $output = ob_get_contents();
    ob_end_clean();


    $tpl = str_replace('{{dynamic_area}}', $output, $template);
    echo $tpl;
?>