<?php
// criar conexao com o banco de dados mysql
include_once '../conexao/conexao.php';

// criar variaveis com os parametros da imagem enviada do formulario
$imagem_temp = $_FILES['imagem']['tmp_name'];
$imagem = date('Hms') . $_FILES['imagem']['name'];
$pasta = 'uploads/';

// enviar imagem para a pasta uploads
$enviouImagem = move_uploaded_file($imagem_temp, $pasta . $imagem);

// verificar se a imagem foi enviada
if ($enviouImagem) {
    // criar variaveis com os valores enviados do formulario
    $id = $_GET['id'];
    $nome = $_POST['nome'];
    $preco = str_replace(',', '.', $_POST['preco']);
    $qtd = str_replace(',', '.', $_POST['qtd']);
    $descricao = $_POST['descricao'];

    // verificar se o id do produto existe
    if ($id == '') {
        // se o id nao exite, criar variavel com o comando sql de inserir um novo produto
        $sql = "insert into tbprodutos(nome, preco, qtd, imagem, descricao) values('$nome', '$preco', '$qtd', '$imagem', '$descricao')";
    } else {
        // se o id existe, criar variavel com o comando sql de atualizar o produto existente
        $sql = "update tbprodutos set nome = '$nome', preco = '$preco', qtd = '$qtd', imagem = '$imagem', descricao = '$descricao' where id = '$id'";
    }

    // executar o comando sql no banco de dados
    $conn->query($sql);    
}
?>
<script type="text/javascript">
    alert('Enviado com sucesso!');
    location.href = "produto.php";
</script>