<?php

    require_once 'App/Core/core.php';
    require_once 'App/Controller/HomeController.php';
    require_once 'App/Controller/ErroController.php';
    require_once 'App/Controller/PostController.php';
    require_once 'App/Controller/SobreController.php';
    require_once 'App/Controller/AdminController.php';
    require_once 'Lib/Database/Connection.php';
    require_once 'vendor/autoload.php';
    require_once 'App/Model/Postagem.php';
    require_once 'App/Model/Comentario.php';

    $template = file_get_contents('App/Template/estrutura.html');
    
    ob_start();    
        $core = new Core;
        $core->start($_GET);

        $saida = ob_get_contents();
    ob_end_clean();

    $tpl = str_replace('{{conteudo_aqui}}', $saida, $template);

    echo $tpl;

?>