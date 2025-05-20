<?php 

namespace Microblog\Auth;

ControleDeAcesso::exigirAdmin();

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



    public static function exigirLogin(): void
    {   //inicia sessao (se necessario)
        self::iniciarSessao();

        //se nao existir uma variavel de sessao chamada id
        if (!isset($_SESSION["id"])) {
            session_destroy();
            header("Location:../login.php?acesso_proibido");
            exit();
        }
    }

    public static function login(int $id, string $nome, string $tipo) :void
    {
        self::iniciarSessao();
        //definindo variaveis de sessao com dados de quem logou
        $_SESSION["id"] = $id;
        $_SESSION["nome"] = $nome;
        $_SESSION["tipo"] = $tipo;
    }

    public static function logout(): void
    {
        self::iniciarSessao();

        session_destroy();
        header("Location:../login.php?logout");
        exit;
    }

    public static function exigirAdmin(): void
    {
        self::iniciarSessao();

        //se o tipo de usuario for diferente de admin
        if ($_SESSION["tipo"] != "admin") {
            session_destroy();
            header("Location:nao-autorizado.php");
            exit();
        }
    }
}