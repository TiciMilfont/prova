<?php 

// inicio sessao

session_start();

if (!isset ($session ["atualizacao_staff"])) {
    $_SESSION ["atualizacao_staff"] =0;

}

// carregar atualizações
require_once __DIR__ . "/funcoes.php";
require_once __DIR__ . "/funcionarios.php";
$funcionarios = lerFuncionarios();
$mensagem = " ";

//processar forms

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $acao = $_POST ["acao"] ?? "cadastrar";

    //cadastrar novos funcionarios

    if ($acao == "cadastrar") {
        $nome = trim ($_POST ["nome"] ?? " ");
        $e_mail = trim ($_POST ["e_mail"] ?? " ");
        $salario = trim ($_POST ["salario"] ?? " ");
        $tipo_staff = $_POST ["tipo_staff"] ?? " ";

        if ($nome == " " || $tipo_staff == " " || $e_mail == " " || $salario == " " ) {
            $mensagem = "Erro: preencha todos os campos!";
        } else {
            if ($tipo_staff == "Atendente") {
                $mensagem = " Olá atendente" . $nome ;
            } elseif ($tipo_staff == "Gerente") {
                $mensagem = " Olá gerente" . $nome ;
        } elseif ($tipo_staff == "Supervisor") {
                $mensagem = " Olá supervisor" . $nome ;
    } else {
        $mensagem = "erro: tipo de funcionário inválido.";
    }
}



 // salvar no json, só sei nesse

 salvarFuncionarios($funcionarios);
 header ("Location: index.php? cadastrado =1");
 exit;

} else {
    $mensagem = "Erro: funcionário não cadastrado!";
}
}

?>

 //A exclusão deve exigir confirmação por formulário POST antes de alterar o banco de dados.
 // tipos de funcionarios : atendente / gerente / supervisor

<!DOCTYPE HTML>
<HTML lang="PT-BR">
    <head>

    <meta charrset ="UTF-8">
    <meta name= "viewport" content = "width - device - width, initial- scale = 1.0">
    <title> CADASTRO DE FUNCIONÁRIOS </title>
    <link rel="stylesheet" href="style.css">

    </head>

    <body>

<h1> CENTRAL DE CADASTRO </h1>
<h3 class = class = "atualizacao_staff">
    Atualizações cadastrais desta sessão:
    <?=$_SESSION ["atualizacao_staff"]?>
</h3>

<?php if (mensagem != " ") : ?>
    <p> <?= htmlspecialchars($mensagem) ?> </p>

    <?php endif ; ?>

    <h2> CADASTRAR NOVO FUNCIONÁRIO</h2>

    <form method = "POST">
        <input type= " hidden" name = "nome" required>
        <br> <br>

        <label> Tipo de funcionário:: </label>
        <select name = "tipo_staff" required>
        <option value = " "> Selecione: </option>
        <option value = "Atendente"> Atendente </option>
        <option value = "Gerente"> Gerente </option>
        <option value = "Supervisor"> Supervisor </option>
        </select>

        <br> <br>
        <label> Nome: </label>
        <input type="text" name= "nome" required>

         <br> <br>
        <label> <E-mail>E-mail: </E-mail>: </label>
        <input type="text" name= "e_mail" required>

         <br> <br>
        <label> Salário: </label>
        <input type="number" name= "salario" required>
         <br> <br>

         <button type="submit"> CADASTRAR </button>



    </form>

    <hr>

    <h2> Funcionários cadastrados: </h2>

     <?php else: ?> 
        <?php foreach ($funcionario as $indice => $funcionario) : ?>
            <div class = "staff-card">
                <h3>
                    <?= htmlspecialchars ($funcionario ["nome"] ?? " ")
                    ?>
                </h3>
                <p>
                    <strong> Função: </strong>
                    <?= htmlspecialchars($funcionario ["nome"] ?? "não informado") ?>
                    <br>
                    <!-- botão excluir VERIFICAR A EXCLUSÂO ESTA OK -->
                     <form method = "GET">
                        <input type = "hidden" nome = "acao_excluir" value = "excluir">
                        <input type = "hidden" name ="indice" value = "<?= $indice ?> ">


                        <button type= "submit">
                            <?= ($funcionario["ativo"] ) ?>
                       </button>
                     </form>
                </p>
            </div>

            <?php endforeach ; ?>
                <?php php endif; ?>

                  <!-- pop-up excluir-->
<?php if (isset ($_GET ["Funcionário excluido!"])) : ?>

    <script>

        window.history.replacestate({ }, " ", "index.php");
        alert ("Funcionário excluido!");
        </script>

        <?php endif; ?>



    </body>

    </html>


