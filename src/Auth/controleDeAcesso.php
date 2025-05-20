<?php 

namespace Microblog\Auth;

//sobre sessoes- no php sessão(session) é uma funcionalidade usada para controle de acesso e outras imformações que seja importante enquanto o navegador estiver aberto no site

//exemplos: areas administrativas painel de controle/dashboard, area de cliente. areade aluno, etc.

// nesta area o acesso se da atraves de agumas formas de autenticação.Exemplos: login/senha biometria, token, etc. 

final class ControleDeAcesso
{
    private function __construct() {}

    
    public static function iniciarSessao(): void
    {
        if (!isset($_SESSION))session_start();
    }



    public function exigirLogin(): void
    {   //inicia sessao (se necessario)
        self::iniciarSessao();

        //se nao existir uma variavel de sessao chamada id
        if (!isset($_SESSION["id"])) {
            session_destroy();
            header("Location:../login.php?acesso_proibido");
            exit();
        }
    }
}