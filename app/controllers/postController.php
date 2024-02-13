<?php

    class PostController
    {
        public function index($params)
        {
            try
            {
                $collect = Post::selectId($params);

                $loader = new \Twig\Loader\FilesystemLoader('app/view/');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('single.html');

                $args = array();
                $args['title'] = $collect->title;
                $args['content'] = $collect->content;
                $args['comments'] = $collect->comments;

                $content = $template->render($args);

                echo $content;
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>