<?php

    Class HomeController{

        public function index(){

            try {

                $colect = Postagem::selecionaTodos();

                $loader = new \Twig\Loader\FilesystemLoader('App/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $parametro = array();
                $parametro['postagens'] = $colect;

                $conteudo = $template->render($parametro);
                echo $conteudo;

            } 
            catch (Exception $e) {

                echo $e->getMessage();

            }
            
        }
    }

?>