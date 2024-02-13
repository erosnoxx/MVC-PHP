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
            {
                $res[] = $row;
            }

            if (!$res) {
                throw new Exception("Error Processing Request");
            }

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

            return $res;
        }
    }
?>