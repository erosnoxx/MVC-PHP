<?php

    class HomeController
    {
        public function index()
        {
            try
            {
                $collect = Post::selectAll();

                $loader = new \Twig\Loader\FilesystemLoader('app/view/');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $params = array();
                $params['posts'] = $collect;

                $content = $template->render($params);

                echo $content;
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>