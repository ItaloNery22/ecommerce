<?php
include_once '../conexao/conexao.php';

$id = $_GET['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

if ($id == '') {
    $sql = "insert into tbcliente(nome, email, telefone) values('$nome', '$email', '$telefone')";
} else {
    $sql = "update tbcliente set nome = '$nome', email = '$email', telefone = '$telefone' where id = '$id'";
}

$conn->query($sql);
?>
<script type="text/javascript">
    alert('Enviado com sucesso!');
    location.href = "cliente.php";
</script>