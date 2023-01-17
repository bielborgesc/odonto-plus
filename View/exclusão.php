<?php
include("../Controler/processamento.php");
//Recupera os valores dos campos
obterCampos();
// Processa informação
if ($operacao == "Excluir") {
    excluir();
} else if ($operacao == "Cancelar") {
    //Redirecionar para a página principal
    header("Location: ../index.php");
}
//Obtem os consultas cadastrados
$consultas = selecionarPorId();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../Content/css/estilo.css">
</head>

<body class="container-fluid black-background">
    <!-- Cabeçalho -->
    <header>
        <div class="row">
            <div class="col-10 jumbotron jumbotron-fluid blue-background white-color">
                <div class="container">
                    <h1 class="display-4 titulo">ODONTO PLUS</h1>
                    <p class="lead subtitulo">Onde os seus dentes podem +</p>
                </div>
            </div>
            <div class="col-2 jumbotron jumbotron red-background">
                <img src="../Content/images/logoMarca.png" alt="Logo azul de um dente um simbolo vermelho" class="img-thumbnail">
            </div>
        </div>
    </header>
    <!-- Página de Cadastro -->
    <main class="container white-color texto">
        <form name="" action="" method="POST">
            <div class="form-group">
                <label for="nomeForm">Nome</label>
                <input readonly value="<?php echo $consultas[0]['Nome']; ?>" type="text" class="form-control" name="txtNome" id="nomeForm">
            </div>
            <div class="form-group">
                <label for="cpfForm">CPF</label>
                <input readonly type="text" value="<?php echo $consultas[0]['Cpf']; ?>" class="form-control" name="txtCpf" id="cpfForm">
            </div>
            <div class="form-group">
                <label for="telForm">Telefone</label>
                <input readonly type="number" value="<?php echo $consultas[0]['Telefone']; ?>" class="form-control" name="nbmTel" id="telForm">
            </div>
            <div class="form-group">
                <label for="emailForm">E-mail</label>
                <input readonly type="email" class="form-control" value="<?php echo $consultas[0]['Email']; ?>" name="txtEmail" id="emailForm">
            </div>
            <div class="form-group">
                <label class="my-1 mr-2" for="selectForm">Qual profissional você deseja</label>
                <select class="custom-select my-1 mr-sm-2" id="selectForm" name="slcForm" disabled>
                    <option value="<?php echo $consultas[0]['Profissional']; ?>"> <?php echo $consultas[0]['Profissional']; ?> </option>
                </select>
            </div>
            <div class="form-group">
                <label for="dataForm">Data </label>
                <input readonly type="text" class="form-control" name="dteData" id="dataForm" value="<?php echo $consultas[0]['Data_con']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="valorForm">Valor da Consulta:</label>
                <input readonly type="number" class="form-control" name="nbmValor" id="valorForm" value="<?php echo $consultas[0]['Valor']?>">
            </div>
            <div class="form-group">
                <label for="indiceForm">Consulta de número</label>
                <input readonly type="number" value="<?php echo $consultas[0]['idConsultas']; ?>" class="form-control" name="indice" id="indiceForm">
            </div>
            <h2 class="red-color">Deseja Mesmo Excluir?</h2><br>
            <button type="submit" class="btn btn-primary black-background" value="Excluir" name="btnOpcao">Excluir</button>
            <button type="submit" class="btn btn-primary black-background" value="Cancelar" name="btnOpcao">Cancelar</button>
        </form>
    </main>
    <br>
    <!-- Footer -->
    <div class="row">
        <div class="col-12 red-background">
            <footer class="py-4 red-background flex-shrink-0">
                <div class="container text-center">
                    <p class="white-color">© Trabalho feito pro Gabriel Borges e Ailton Alves</p>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>