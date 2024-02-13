<?php 
    class Post
    {
        public static function selectAll()
        {
            $conn = Connection::getConn();

            $sql = 'SELECT * FROM post ORDER BY id DESC';
            $sql = $conn->prepare($sql);
            $sql->execute();

            $res = array();

            while ($row = $sql->fetchObject('Post'))
            {$res[] = $row;}

            if (!$res) {throw new Exception("Error Processing Request");}

            return $res;
        }
        public static function selectId($id)
        {
            $conn = Connection::getConn();

            $sql = 'SELECT * FROM post WHERE id = :id';
            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            $res = $sql->fetchObject('Post');

            if (!$res)
            {
                throw new Exception("Error Processing Request");
            }
            else
            {
                $res->comments = Comments::getComments($res->id);
            }

            return $res;
        }

        public static function insert($data)
        {
            if (empty($data['title']) || empty($data['content']))
            {
                throw new Exception("Preencha todos os campos");

                return false;
            }

            $conn = Connection::getConn();

            $sql = "INSERT INTO post (title, content) VALUES (:tit, :cont)";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':tit', $data['title']);
            $sql->bindValue(':cont', $data['content']);
            $res = $sql->execute();
            
            if ($res === false)
            {
                throw new Exception("Falha ao inserir a publicação.");

                return false;
            }

            return true;
        }

        public static function update($params)
        {
            $conn = Connection::getConn();

            $sql = "UPDATE post SET title = :tit, content = :cont WHERE id = :id";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':tit', $params['title']);
            $sql->bindValue(':cont', $params['content']);
            $sql->bindValue(':id', $params['id']);
            $res = $sql->execute();


            if ($res === false)
            {
                throw new Exception("Falha ao alterar a publicação.");
                return false;
            }

            return true;
        }

        public static function delete($id)
        {
            $conn = Connection::getConn();
            
            $sql = "DELETE FROM post WHERE id = :id";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $id);
            $res = $sql->execute();
            
            if ($res === false)
            {
                throw new Exception("Falha ao deletar a publicação.");
                return false;
            }

            return true;

        }
    }
?>