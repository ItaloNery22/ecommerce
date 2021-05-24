<?php
include_once '../conexao/conexao.php';

$erro = '';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];
$tipo = '2';

if ($senha != $confirmar_senha)
    $erro = 'Senhas não conferem!';

$imagem_temp = $_FILES['imagem']['tmp_name'];
$imagem = date('Hms') . $_FILES['imagem']['name'];
$pasta = 'foto/';

if ($erro == '') {
    $enviouImagem = move_uploaded_file($imagem_temp, $pasta . $imagem);

    if ($enviouImagem == false)
        $erro = 'Imagem não enviada para o servidor!';
}

if ($erro == '') {
    $senhaMD5 = md5($senha);

    $sql = "insert into tbusuario(nome, email, senha, tipo, imagem) "
            . "values('$nome','$email','$senhaMD5','$tipo','$imagem')";

    $conn->query($sql);
    ?>
    <script type="text/javascript">
        alert('<?php echo 'Cadastrado com sucesso!'; ?>');
        location.href = "index.php";
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert('<?php echo $erro; ?>');
        location.href = "index.php";
    </script>
    <?php
}
?>