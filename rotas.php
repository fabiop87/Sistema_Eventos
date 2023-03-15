<?php 
// fazer as rotas para o coordenador e aluno 

//abaixo é um exemplo de outra coisa mas é só  para ajudar a nao ficar perdido
function verifica_sessao()
{
    return isset($_SESSION['usuario']);
}

$rota = null;

if(!verifica_sessao() && $_SERVER['REQUEST_METHOD'] != 'POST'){
    $rota = 'login';
} elseif(!verifica_sessao() && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $rota = 'login_submit';
} else {
    $rota = 'logado';
}


// apresentar os layouts
switch ($rota) {

    // -----------------------------------------------------------
    case 'login':

        // apresentação do formulário de login
        require_once('../views/Login.php');
        break;

    // -----------------------------------------------------------
    case 'login_submit':


        break;

    // -----------------------------------------------------------
    case 'logado':
        
     
        break;
}