<?php
session_start();

include_once '../conexao/conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$senhaMD5 = md5($senha);

$sql = "select * from tbusuario "
        . "where email = '$email' and senha = '$senhaMD5'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // criar sessoes com os dados retornados do usuario
        $_SESSION['idusuario'] = $row['id'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['imagem'] = $row['imagem'];
        $_SESSION['tipo'] = $row['tipo'];
        $_SESSION['seq'] = 0;
    }        
    
    // verificar o valor da sessao tipo, se for 1 o usuario vai para o adm
    if ($_SESSION['tipo'] == '1') {
        ?>
        <script type="text/javascript">
            location.href = "../adm/index.php";
        </script>        
        <?php
        // senao o usuario vai para o ecommerce
    } else {
        if (isset($_SESSION['idproduto']) && $_SESSION['idproduto'] != '') {
            ?>
            <script type="text/javascript">
                location.href = "../market/carrinho.php?idproduto=<?php echo $_SESSION['idproduto']; ?>&preco=<?php echo $_SESSION['preco']; ?>&qtd=<?php echo $_SESSION['qtd']; ?>";
            </script>                     
            <?php
        } else {            
            ?>
            <script type="text/javascript">
                location.href = "../market/index.php?idusuario=<?php echo $_SESSION['idusuario']; ?>";
            </script>   
            <?php
        }
    }
} else {
    ?>
    <script type="text/javascript">
        alert('<?php echo 'Login inválido!'; ?>');
        location.href = "index.php";
    </script>
    <?php
}
?>