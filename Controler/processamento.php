<?php
// Define a hora local
date_default_timezone_set('America/Sao_Paulo');

// Verifica se a sessão está ativa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Limpa a sessão
limparSessao();

//Mensagem de error
function mensagemErro($ex){
    echo "<h2 style='color: red;'>Erro: " .  $ex->getMessage() . "</h2>";
    echo "<p><a href='index.php'>Clique aqui para voltar</a></p>";
}

function mensagemErroSQL($cmdSQL){
    echo "Falha na inserção!<br>";
            var_dump($cmdSQL->errorInfo());
            echo "<p><a href='../index.php'>Clique aqui para voltar</a></p>";
}

// Dados
$operacao = null;
$idConsulta = null;
$nome = null;
$cpf = null;
$telefone = null;
$email = null;
$profissional = null;
$data = null;
$valor = null;


function pegarValor($campo){
    if (isset($_REQUEST[$campo])) {
        if (!empty($_REQUEST[$campo])) {
            return $_REQUEST[$campo];
        }
    }
}

//Obter os campos
function obterCampos()
{
    try {

        global $operacao;
        global $nome;
        global $cpf;
        global $telefone;
        global $email;
        global $profissional;
        global $data;
        global $valor;
        global $idConsulta;

        // Operação
        if (isset($_REQUEST["btnOpcao"])) {
            $operacao = $_REQUEST["btnOpcao"];
        } else {
            $operacao = "Vazio";
        }
        
        $nome = pegarValor("txtNome");
        $cpf = pegarValor("txtCpf");
        $telefone = pegarValor("nbmTel");
        $email = pegarValor("txtEmail");
        $profissional = pegarValor("slcForm");
        $data = pegarValor("dteData");
        $valor = pegarValor("nbmValor");
        $idConsulta = pegarValor("idConsulta");

    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function validarCampos()
{
    try {
        global $nome;
        global $data;
        global $profissional;

        $validar = 1;

        if (empty($nome)) {
            $_SESSION['nomeVazio'] = "Por favor, informe o nome.";
            $validar = 0;
        }

        if (empty($data)) {
            $_SESSION['dataVazio'] = "Por favor, informe a data.";
            $validar = 0;
        }

        if ($profissional == 'Escolher ...') {
            $_SESSION['profissionalVazio'] = "Por favor, informe o profissional.";
            $validar = 0;
        }

        return  $validar;
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

//Libera a sessão
function limparSessao()
{
    try {
        unset($_SESSION['txtNome']);
        unset($_SESSION['txtCpf']);
        unset($_SESSION['nbmTel']);
        unset($_SESSION['txtEmail']);
        unset($_SESSION['slcForm']);
        unset($_SESSION['dteData']);
        unset($_SESSION['nbmValor']);

        unset($_SESSION['nomeVazio']);
        unset($_SESSION['dataVazio']);
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function abriConexao()
{
    $servidor = "localhost";
    $banco = "dentista";
    $usuario = "root";
    $senha = "@Gabriel05";
    $con = null;

    try {

        $con = new PDO(
            "mysql:host=$servidor;dbname=$banco;charset=utf8",
            $usuario,
            $senha
        );

        return $con;
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function inserir()
{
    try {
        global $operacao;
        global $nome;
        global $cpf;
        global $telefone;
        global $email;
        global $profissional;
        global $data;
        global $valor;

        // Validar os campos dentro das regras de negócio
        if (!validarCampos()) {
            return;
        }
        

        $con = abriConexao();

        // Prepara o comando
        $cmdSQL = $con->prepare("INSERT INTO consultas(Nome, Cpf, Telefone, Email, Profissional, Data_con, Valor)
                                 VALUES (:Nome, :Cpf, :Telefone, :Email, :Profissional, :Data_con, :Valor)");

        // Vinculo de parâmetros com variáveis
        $cmdSQL->bindParam(":Nome",  $nome);
        $cmdSQL->bindParam(":Cpf",  $cpf);
        $cmdSQL->bindParam(":Telefone",  $telefone);
        $cmdSQL->bindParam(":Email",  $email);
        $cmdSQL->bindParam(":Profissional",  $profissional);
        $cmdSQL->bindParam(":Data_con",  $data);
        $cmdSQL->bindParam(":Valor",  $valor);

        // Executa o comando
        if ($cmdSQL->execute()) {
            // Limpa a sessão
            limparSessao();
        } else {
            mensagemErroSQL($cmdSQL);
            die();
        }
        // Fecha conexão
        $con = null;
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function selecionarTudo()
{

    try {
        // Abre conexão

        $con = abriConexao();

        // Prepara o comando
        $cmdSQL = $con->prepare("SELECT * FROM Consultas ");

        // Executa o comando
        if ($cmdSQL->execute()) {

            // Obtem um array com todos os resultados
            $consultas = $cmdSQL->fetchAll();

            $con = null;

            if (count($consultas)) {
                //print_r($consultas);
                return $consultas;
            }
        } else {
            return [];
        }

        // Fecha conexão
        $con = null;
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function selecionarPorId()
{

    try {
        global $idConsulta;

        // Abre conexão

        $con = abriConexao();

        // Prepara o comando
        $cmdSQL = $con->prepare("SELECT * FROM Consultas WHERE idConsultas= :idConsultas");

        // Efetua o vínvulo do Parâmetro com a variável
        $cmdSQL->bindParam(":idConsultas", $idConsulta);

        // Executa o comando
        if ($cmdSQL->execute()) {

            // Obtem um array com todos os resultados
            $consultas = $cmdSQL->fetchAll();

            $con = null;

            if (count($consultas)) {
                //print_r($consultas);
                return $consultas;
            }
        } else {
            return [];
        }

        // Fecha conexão
        $con = null;
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function atualizar()
{
    try {
        global $operacao;
        global $nome;
        global $cpf;
        global $telefone;
        global $email;
        global $profissional;
        global $data;
        global $valor;
        global $idConsulta;


        // Validar os campos dentro das regras de negócio
        if (!validarCampos()) {
            return;
        }

        $con = abriConexao();

        // Prepara o comando
        $cmdSQL = $con->prepare("UPDATE Consultas
                                SET Nome = :Nome,
                                Cpf = :Cpf,
                                Telefone = :Telefone,
                                Email = :Email,
                                Profissional = :Profissional,
                                Data_con = :Data_con,
                                Valor = :Valor
                                WHERE idConsultas = :idConsultas");

        // Vinculo de parâmetros com variáveis
        $cmdSQL->bindParam(":idConsultas", $idConsulta);
        $cmdSQL->bindParam(":Nome",  $nome);
        $cmdSQL->bindParam(":Cpf",  $cpf);
        $cmdSQL->bindParam(":Telefone",  $telefone);
        $cmdSQL->bindParam(":Email",  $email);
        $cmdSQL->bindParam(":Profissional",  $profissional);
        $cmdSQL->bindParam(":Data_con",  $data);
        $cmdSQL->bindParam(":Valor",  $valor);

        // Executa o comando
        if ($cmdSQL->execute()) {
            // Limpa a sessão
            limparSessao();

            // Redirecionar para a página principal
            header("Location: ../index.php");
        } else {
            mensagemErroSQL($cmdSQL);
            die();
        }

        // Fecha conexão
        $con = null;
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

function excluir()
{
    try {
        global $idConsulta;

        $con = abriConexao();

        // Prepara o comando
        $cmdSQL = $con->prepare("DELETE FROM Consultas
                                WHERE idConsultas = :idConsultas");

        // Vinculo de parâmetros com variáveis
        $cmdSQL->bindParam(":idConsultas", $idConsulta);

        // Executa o comando
        if ($cmdSQL->execute()) {
            // Limpa a sessão
            limparSessao();

            // Redirecionar para a página principal
            header("Location: ../index.php");
        } else {
            mensagemErroSQL($cmdSQL);
            die();
        }
    } catch (Error $ex) {
        mensagemErro($ex);
        die();
    }
}

?>