<?php

    class AdminController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/view/');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');

            $objPost = Post::selectAll();

            $args = array();
            $args['posts'] = $objPost;

            $content = $template->render($args);

            echo $content;
        }

        public function create()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/view/');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('create.html');

            $args = array();

            $content = $template->render($args);

            echo $content;
        }

        public function insert()
        {
            try {
                Post::insert($_POST);

                echo '<script>alert("Publicação inserida com sucesso!");</script>';
                echo '<script>location.href="?page=admin&method=index"</script>';
            } catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=admin&method=create"</script>';
            }
            
        }

        public function change($id)
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/view/');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('update.html');

            $post = Post::selectId($id);

            $args = array();
            $args['id'] = $post->id;
            $args['title'] = $post->title;
            $args['content'] = $post->content;

            $content = $template->render($args);

            echo $content;
        }

        public function update()
        {
            try {
                Post::update($_POST);

                echo '<script>alert("Publicação alterada com sucesso!");</script>';
                echo '<script>location.href="?page=admin&method=index"</script>';
            }
            catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=admin&method=change&id='.$_POST['id'].'"</script>';
            }
        }

        public function delete($id)
        {
            try
            {
                Post::delete($id);

                echo '<script>alert("Publicação deletada com sucesso!");</script>';
                echo '<script>location.href="?page=admin&method=index"</script>';
            }
            catch (Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=admin&method=index"</script>';
            }
        }
    }
?>