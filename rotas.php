<?php 

// Função para verificar se o usuário está logado
function verifica_sessao()
{
    return isset($_SESSION['usuario']);
}

// Verificar o tipo de usuário (coordenador ou aluno) e determinar a rota
if(verifica_sessao() && $_SESSION['tipo_usuario'] == 'coordenador') {
    $rota = isset($_GET['rota']) ? $_GET['rota'] : 'CadastroEvetos';
} elseif(verifica_sessao() && $_SESSION['tipo_usuario'] == 'aluno') {
    $rota = isset($_GET['rota']) ? $_GET['rota'] : 'InscricaoEventos';
} else {
    $rota = 'login';
}

// Executar a ação apropriada com base na rota
switch ($rota) {

    case 'login':
        require_once('./Views/Login.php');
        break;

    case 'cadastrar_aula':
        // Verificar se o formulário foi enviado e tratar os dados
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Tratar os dados do formulário e salvar no banco de dados
            // Redirecionar para uma página de confirmação ou exibir uma mensagem de sucesso
        } else {
            require_once('views/CadastroEventos.php');
        }
        break;

    case 'inscrever_aula':
        // Verificar se o formulário foi enviado e tratar os dados
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Tratar os dados do formulário e salvar no banco de dados
            // Redirecionar para uma página de confirmação ou exibir uma mensagem de sucesso
        } else {
            require_once('./Views/InscricaoEventos.php');
        }
        break;

    default:
        // Rota inválida, redirecionar para a página de login
        header('Location: index.php');
        exit();
        break;
}
