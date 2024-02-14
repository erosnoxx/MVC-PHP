<?php 
    class Comments
    {
        public static function getComments($idPost)
        {
            $conn = Connection::getConn();

            $sql = "SELECT * FROM comments WHERE id_post = :id ORDER BY id DESC";
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

        public static function addComments($data)
        {
            $conn = Connection::getConn();

            $sql = "INSERT INTO comments (name, message, id_post) VALUES (:name, :message, :id)";
            $sql = $conn->prepare($sql);
            $sql->bindValue(':name',$data['name']);
            $sql->bindValue(':message',$data['msg']);            
            $sql->bindValue(':id',$data['id']);            
            $sql->execute();

            if ($sql->rowCount())
            {
                return true;
            }

            throw new Exception("Falha na inserção.");
        }
    }
?>