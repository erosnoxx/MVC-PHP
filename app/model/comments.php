<?php 
    class Comments
    {
        public static function getComments($idPost)
        {
            $conn = Connection::getConn();

            $sql = "SELECT * FROM comments WHERE id_post = :id";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':id',$idPost, PDO::PARAM_INT);
            $sql->execute();

            $res = array();

            while ($row = $sql->fetchObject('Comments'))
            {
                $res[] = $row;
            }

            return $res;
        }
    }
?>