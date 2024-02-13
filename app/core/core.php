<?php 
    class Core
    {
        public function start($urlGet)
        {
            if (isset($urlGet['page']))
            {$controller = $urlGet['page'].'Controller';}
            else
            {$controller = 'homeController';}

            $action = 'index';
            

            if (!class_exists($controller))
            {
                $controller = 'errorController';
            }

            if (isset($urlGet['id']) && $urlGet['id'] != null)
            {$id = $urlGet['id']; } else { $id = null; }

            call_user_func_array(array(new $controller, $action), array($id));
        }
    }

?>