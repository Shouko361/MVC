<?php

    Class Postagem{

        public static function selecionaTodos(){

            $con = Connection::getConn();

            $sql = "SELECT * FROM postagem ORDER BY id_post";
            $sql = $con->prepare($sql);
            $sql->execute();

            $result = array();

            while ($row = $sql->fetchObject('Postagem')){
 
                $result[] = $row;

            }

            if(!$result){

                throw new Expection("Não foi encontrado nenhum registro em nosso banco de dados!! Por favor tente mais tarde!");
            }

            return $result;
        }

        public static function selecionarPorId($idPost){

            $con = Connection::getConn();

            $sql = "SELECT * FROM postagem WHERE id_post = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Postagem');

            if(!$resultado){

                throw new Exception("Não foi encontrado nenhum registro em nosso banco de dados!! Por favor tente mais tarde!");

            }
            else{

				$resultado->comentario = Comentario::selecionarComentarios($resultado->id_post);
            
            }
            return $resultado;
        }

        Public static function insert($dadosPost){

            if(empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])){

                throw new Exception("Preencha todos os campos");
                return false;

            }

            $con = Connection::getConn();
            $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)";
            $sql = $con->prepare($sql);
            $sql->bindValue(':titulo', $dadosPost['titulo']);
            $sql->bindValue(':conteudo', $dadosPost['conteudo']);
            $res = $sql->execute();
            
            if($res == 0){

                throw new Exception("Falha ao inserir no banco de dados");
                return false;

            }

            return true;
        }

        public static function update($param){

            $con = Connection::getConn();

            $sql = "UPDATE postagem SET titulo = :titulo, conteudo = :conteudo WHERE id_post = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':titulo', $param['titulo']);
            $sql->bindValue(':conteudo', $param['conteudo']);
            $sql->bindValue(':id', $param['id_post']);
            $resultado = $sql->execute();

            if($resultado == 0){

                throw new Exception("Falha ao atualizar os dados!");
                return false;

            }

            return true;

        }

        public static function delete($id){

            $con = Connection::getConn();

            $sql = "DELETE FROM postagem WHERE id_post = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $id);
            $resultado = $sql->execute();

            if($resultado == 0){

                throw new Exception("Falha ao deletar os dados!");
                return false;

            }

            return true;

        }

    }       

?>