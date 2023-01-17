<?php
    include("./Controler/processamento.php");
    //Recuperar os valores dos campos
    obterCampos();
    if($operacao == "Enviar"){
        inserir();
    }
    //Obtem as consultas agendadas
    $consultas = selecionarTudo();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="Content/css/estilo.css">
</head>
<body class="container-fluid black-background">
    <!-- Header -->
    <header>
        <div class="row">
            <div class="col-10 jumbotron jumbotron-fluid blue-background white-color">
                <div class="container">
                    <h1 class="display-4 titulo">ODONTO PLUS</h1>
                    <p class="lead subtitulo">Onde os seus dentes podem +</p>
                </div>
            </div>
            <div class="col-2 jumbotron jumbotron red-background">
                <img src="Content/images/logoMarca.png" alt="Logo azul de um dente um simbolo vermelho" class="img-thumbnail">
            </div>
        </div>
    </header>
    <!-- Página de Cadastro -->
    <main class="white-color container-laund texto">
        <section class="row">
            <div class="col-12">
                <h2>Agendar Consulta</h2><br>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nomeForm">Nome</label>
                        <input type="text" class="form-control" name="txtNome" id="nomeForm" placeholder="Digite seu nome completo">
                    </div>
                    <div class="form-group">
                        <label for="cpfForm">CPF</label>
                        <input type="text" class="form-control" name="txtCpf" id="cpfForm" placeholder="Digite seu CPF sem traços e pontos" MAXLENGTH = 11>
                    </div>
                    <div class="form-group">
                        <label for="telForm">Telefone</label>
                        <input type="number" class="form-control" name="nbmTel" id="telForm" placeholder="Informe seu telefone com DDD" max = 99999999999>
                    </div>
                    <div class="form-group">
                        <label for="emailForm">E-mail</label>
                        <input type="email" class="form-control" name="txtEmail" id="emailForm" placeholder="Informe seu email">
                    </div>               
                    <div class="form-group">
                        <label class="my-1 mr-2" for="selectForm">Qual profissional você deseja</label>
                        <select class="custom-select my-1 mr-sm-2" id="selectForm" name="slcForm">
                            <option value="Escolher ...">Escolher ...</option>
                            <option value="Felipe - Dentista">Felipe - Dentista</option>
                            <option value="Marcelo - Dentista">Marcelo - Dentista</option>
                            <option value="Andressa - Cirurgiã">Andressa - Cirurgiã</option>
                            <option value="Cleuza - Estomatologia">Cleuza - Estomatologia</option>
                            <option value="Maria Heloisa - Odontologia Estética">Maria Heloisa - Odontologia Estética</option>
                            <option value="Henrique - Ortodontia">Henrique - Ortodontia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dataForm">Data </label>
                        <input type="date" class="form-control" name="dteData" id="dataForm">
                    </div> 
                    <br>
                    <div class="form-group">
                        <label for="valorForm">Valor da Consulta:</label>
                        <input type="number" class="form-control" name="nbmValor" id="valorForm" placeholder="Informe o valor da consulta com as casas decimais">
                    </div> 
                    <button type="submit" class="btn btn-primary black-background" value="Enviar" name="btnOpcao">Enviar</button>
                </form>
            </div>
        </section>
        <hr class="green-background">
        <section class="row">
            <div class="col-12 container">
                <h2 class="red-color">Consultas Marcadas</h2><br>
                <aside>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr class="green-background">
                            <th scope="col">N°</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Médico</th>
                            <th scope="col">Data</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Alterar</th>
                            <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($consultas as $consulta){?>
                                <tr>
                                    <th scope="row"><?php echo $consulta['idConsultas']; ?></th>
                                    <th><?php echo $consulta['Nome']; ?></th>
                                    <td><?php echo $consulta['Cpf']; ?></td>
                                    <td><?php echo $consulta['Telefone']; ?></td>
                                    <td><?php echo $consulta['Email']; ?></td>
                                    <td><?php echo $consulta['Profissional']; ?></td>
                                    <td><?php echo $consulta['Data_con']; ?></td>
                                    <td><?php echo $consulta['Valor']; ?></td>
                                    <td><?php echo "<a href='View/alteração.php?idConsulta=$consulta[idConsultas]'><img src='Content/images/edição.png' alt='Um X vermelho' width='40px' height='30px'></a>"?></td>
                                    <td><?php echo "<a href='View/exclusão.php?idConsulta=$consulta[idConsultas]'><img src='Content/images/excluir.png' alt='Um X vermelho' width='40px' height='30px'></a>"?></td>  
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </aside>
            </div>
        </section>
    </main>
    <br>
    <!-- Footer -->
    <div class="row">
        <div class="col-12 red-background">
            <footer class="py-4 red-background flex-shrink-0">
                <div class="container text-center">
                    <p class="white-color">&copy Trabalho feito pro Gabriel Borges e Ailton Alves</p>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>