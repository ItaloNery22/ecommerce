<?php
include_once '../conexao/conexao.php';

$imagem_temp = $_FILES['imagem']['tmp_name'];
$imagem = date('Hms') . $_FILES['imagem']['name'];
$pasta = 'uploads/';

$enviouImagem = move_uploaded_file($imagem_temp, $pasta . $imagem);

if ($enviouImagem) {    
    $id = $_GET['id'];
    $nome = $_POST['nome'];
    $preco = str_replace(',', '.', $_POST['preco']);
    $qtd = str_replace(',', '.', $_POST['qtd']);
    $detalhes = $_POST['detalhes'];
    
    if ($id == '') {        
        $sql = "insert into tbproduto(nome, preco, qtd, imagem, detalhes) values('$nome', '$preco', '$qtd', '$imagem', '$detalhes')";
    } else {        
        $sql = "update tbproduto set nome = '$nome', preco = '$preco', qtd = '$qtd', imagem = '$imagem', detalhes = '$detalhes' where id = '$id'";
    }
    
    $conn->query($sql);    
}
?>
<script type="text/javascript">
    alert('Enviado com sucesso!');
    location.href = "produto.php";
</script>