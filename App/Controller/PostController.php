<?php

    Class PostController{

        public function index($params){

            try {

                $postagem = Postagem::selecionarPorId($params);
                
                $loader = new \Twig\Loader\FilesystemLoader('App/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('single.html');


                $parametro = array();
                $parametro['id'] = $postagem->id_post;

                $parametro['titulo'] = $postagem->titulo;

                $parametro['conteudo'] = $postagem->conteudo;

                $parametro['comentario'] = $postagem->comentario;


                $conteudo = $template->render($parametro);
                echo $conteudo;

            } 
            catch (Exception $e) {

                echo $e->getMessage();

            }
            
        }

        public function addComent(){

            try {
                
                Comentario::inserir($_POST);
                echo '<script>alert("Comentario adicionado com sucesso!! :)");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=post&id='.$_POST['id'].'"</script>';



            } catch (Exception $e) {
                
                echo '<script>alert("'.$e->getMessage().'");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=post&id='.$_POST['id'].'"</script>';

            }

        }
    }

?>