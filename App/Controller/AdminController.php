<?php

	class AdminController{

		public function index(){
			$loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');

            $objPostagem = Postagem::selecionaTodos();

			$parametros = array();
            $parametros['postagens'] = $objPostagem;

			$conteudo = $template->render($parametros);
			echo $conteudo;
		}

        public function create(){
            
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('create.html');

			$parametros = array();

			$conteudo = $template->render($parametros);
			echo $conteudo;

        }

        public function insert(){
            
            try {

                Postagem::insert($_POST);
                echo '<script>alert("Postado com sucesso!!");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=admin&metodo=index"</script>';
            }
            catch (Exception $e){
                
                echo '<script>alert("'.$e->getMessage().'");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=admin&metodo=create"</script>';


            }

        }

        public function change($paramId){

            $post = Postagem::selecionarPorId($paramId);

            $loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('update.html');
            
			$parametros = array();
            $parametros['id_post'] = $post->id_post;
            $parametros['titulo'] = $post->titulo;
            $parametros['conteudo'] = $post->conteudo;

			$conteudo = $template->render($parametros);
			echo $conteudo;
        
        }

        public function update(){

            try {

                Postagem::update($_POST);
                echo '<script>alert("Alteração feita com sucesso!!");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=admin&metodo=index"</script>';

            } 
            catch(Exception $e){

                echo '<script>alert("'.$e->getMessage().'");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=admin&metodo=change&id='.$_POST['id_post'].'"</script>';

            }

        }
        
        public function delete($paramId){

            try {
                
                Postagem::delete($paramId);
                echo '<script>alert("Deletado com sucesso!!");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=admin&metodo=index"</script>';

            } catch (Exception $e){
                                
                echo '<script>alert("'.$e->getMessage().'");</script>';

                echo '<script>location.href="http://localhost/MVC-main/?pag=admin&metodo=index"</script>';

            }

        }
        
	}

?>