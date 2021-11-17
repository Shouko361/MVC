<?php

    Class Core{
        
        public function start($urlGet){

            if(isset($urlGet['metodo'])){

                $acao = $urlGet['metodo'];
                
            }
            else{

                $acao = 'index';

            }

            if (isset($urlGet['pag'])) {
                $controller = ucfirst($urlGet['pag'].'Controller');
            }
            else{
                $controller = 'HomeController';
            }


            if (!class_exists($controller)){
                $controller = 'ErroController';
            }

            if (isset($urlGet['id']) && $urlGet['id'] != null) {
                
                $id = $urlGet['id'];

            }
            else{

                $id = null;

            }

            call_user_func_array(array(new $controller, $acao), array($id));
        }
    }

?>