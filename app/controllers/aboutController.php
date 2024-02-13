<?php

    class AboutController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/view/');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('about.html');

            $args = array();

            $content = $template->render($args);

            echo $content;
        }
    }
?>