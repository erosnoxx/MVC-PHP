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
                $args['id'] = $collect->id;


                $content = $template->render($args);

                echo $content;
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        
        public Function addComment()
        {
            try {
                Comments::addComments($_POST);

                header("Location: ?page=post&id=" . $_POST['id']);
            } catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=post&id='.$_POST['id'].'"</script>';
            }
        }
    }
?>