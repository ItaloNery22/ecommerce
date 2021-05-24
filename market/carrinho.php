<?php
// criar sessao
session_start();

// criar conexao com o banco de dados mysql
include_once '../conexao/conexao.php';

// verificar se sessao nome existe
if ($_SESSION['nome'] == '') {
    // verificar se idusuario foi enviado pela url
    if (!isset($_GET['idusuario'])) {
        $_SESSION['idproduto'] = $_GET['idproduto'];
        $_SESSION['preco'] = $_GET['preco'];
        $_SESSION['qtd'] = $_GET['qtd'];
        $_SESSION['seq'] = $_GET['seq'];
        header('Location: ../login/index.php');
        exit();
    }
}

// capturar a sequencia dos itens passado via get
if (isset($_GET['seq'])) {
    $seq = $_GET['seq'];
} else {
    $seq = 0;
}

// verificar se idproduto foi enviado pela url
if (isset($_GET['idproduto'])) {
    $idproduto = $_GET['idproduto'];
}

// verificar se qtd foi enviado pela url
if (isset($_GET['qtd'])) {
    $qtd = $_GET['qtd'];
}

// verificar se preco foi enviado pela url
if (isset($_GET['preco'])) {
    $preco = $_GET['preco'];
}

// verificar se idvenda foi enviado pela url
if ($_SESSION['idvenda'] != '') {
    // criar variavel com o valor de idvenda
    $idvenda = $_SESSION['idvenda'];

    // verificar se a sequencia da sessao esta menor que a passada via get
    if ($_SESSION['seq'] < $seq) {
        // aumentar a sequencia da sessao para o proximo item
        $_SESSION['seq'] = intval($_SESSION['seq'] + 1);
        // verificar se variavel idproduto existe
        if (isset($idproduto)) {
            // criar variavel com o comando sql para inserir um item da venda
            $sql = "insert into tbitemvenda(idvenda, idproduto, qtd) values('$idvenda', '$idproduto', '$qtd')";
            // executa o comando sql no banco de dados
            $conn->query($sql);
            // criar variavel com o comando sql para atualizar a qtd do item
            $sql = "update tbproduto set qtd = qtd - '$qtd' where id = '$idproduto'";
            // executa o comando sql no banco de dados
            $conn->query($sql);
            // calcular o subtotal da venda
            $subtotal = $qtd * $preco;
            // criar variavel com o comando sql para atualzar o valor da venda
            $sql = "update tbvenda set valor = valor + '$subtotal' where id = '$idvenda'";
            // executar o comando sql no banco de dados
            $conn->query($sql);
        }
    }

    // criar variavel com o comando sql para retornar a venda pelo sessao idvenda
    $sql = "select * from tbvenda where id = '$idvenda'";
    // executar comando sql no banco de dados
    $result = $conn->query($sql);
    // verificar se o retorno voltou alguma venda
    if ($result->num_rows > 0) {
        // repetir ate a ultima venda
        while ($row = $result->fetch_assoc()) {
            // atualizar a sessao total da venda
            $_SESSION['total'] = $row['valor'];
        }
    }
// se idvenda nao foi enviado pela url
} else {
    // aumentar a sequencia da sessao para o proximo item
    $_SESSION['seq'] = intval($_SESSION['seq'] + 1);

    // calcular o subtotal da venda
    $subtotal = $qtd * $preco;
    // criar variavel com o comando sql para inseir uma nova venda
    $sql = "insert into tbvenda(data, hora, valor, idusuario) values(CURRENT_DATE, CURRENT_TIME, '$subtotal', '$_SESSION[idusuario]')";
    // executar o comando sql no banco de dados
    $conn->query($sql);
    // criar variavel com o comando sql para retornar a ultima venda inserida
    $sql = "select * from tbvenda order by id desc limit 1";
    // executar o comando sql no banco de dados
    $result = $conn->query($sql);

    // verificar se o retorno voltou alguma venda 
    if ($result->num_rows > 0) {
        // repetir ate a ultima venda
        while ($row = $result->fetch_assoc()) {
            // criar sessao idvenda com o id retornado do banco de dados
            $_SESSION['idvenda'] = $row['id'];
            // criar sessao total com o valor da venda retornado do banco de dados
            $_SESSION['total'] = $row['valor'];
        }
    }

    // criar variavel idvenda com o valor da sessao idvenda
    $idvenda = $_SESSION['idvenda'];
    // criar variavel com o comando sql para inserir um itemvenda
    $sql = "insert into tbitemvenda(idvenda, idproduto, qtd) values('$idvenda', '$idproduto', '$qtd')";
    // executar comando sql no banco de dados
    $conn->query($sql);
    // criar variavel com o comando sql para atualizar a qtd do item
    $sql = "update tbproduto set qtd = qtd - '$qtd' where id = '$idproduto'";
    // executa o comando sql no banco de dados
    $conn->query($sql);
}

// criar variavel idvenda com o valor da sessao idvenda
$idvenda = $_SESSION['idvenda'];
// criar variavel com o comando sql para retornar a quantidade de itens na venda
$sql = "select count(*) as qtditem from tbitemvenda where idvenda = '$idvenda'";
// executar comando sql no banco de dados
$result = $conn->query($sql);

// verificar se o retorno voltou alguma quantidade
if ($result->num_rows > 0) {
    // repetir ate a ultima quantidade
    while ($row = $result->fetch_assoc()) {
        // criar sessao qtditem com a quantidade de itens da venda
        $_SESSION['qtditem'] = $row['qtditem'];
    }
}

// criar variavel com o comando sql para retornar os itens da venda
$sql = "select a.*, b.qtd from tbproduto a, tbitemvenda b where a.id = b.idproduto and b.idvenda = '$idvenda'";
// executar o comando sql no banco de dados
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<head>
    <?php include_once 'cabecalho.php'; ?>
</head>
<body>
    <?php include_once 'menu.php'; ?>

    <div class="section section-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Carrinho</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <?php
            // verificar se o retorno voltou algum item da venda
            if ($result->num_rows > 0) {
                // repetir ate o ultimo item da venda
                while ($row = $result->fetch_assoc()) {
                    // calcular o subtotal do item da venda
                    $subtotal = $row['qtd'] * $row['preco'];
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="shopping-cart">
                                <tr>
                                    <td class="image"><img src="../adm/uploads/<?php echo $row['imagem'] ?>"></td>
                                    <td>
                                        <div class="cart-item-title"><?php echo $row['nome']; ?></div>                                        
                                    </td>
                                    <td class="quantity"> 
                                        Qtd:
                                        <input style="width: 50px;" class="form-control input-sm input-micro" type="text" readonly="true" value="<?php echo $row['qtd']; ?>">
                                    </td>
                                    <td class="quantity"> 
                                        Preco:
                                        <input style="width: 100px;" class="form-control input-sm input-micro" type="text" readonly="true" value="<?php echo 'R$ ' . number_format($row['preco'], 2, ',', '.'); ?>">
                                    </td>
                                    <td class="quantity"> 
                                        Subtotal:
                                        <input style="width: 100px;" class="form-control input-sm input-micro" type="text" readonly="true" value="<?php echo 'R$ ' . number_format($subtotal, 2, ',', '.'); ?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="row">
                <div class="col-md-4  col-md-offset-0 col-sm-6 col-sm-offset-6">
                    <div class="cart-promo-code">

                    </div>
                </div>
                <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-6">
                    <div class="cart-shippment-options">

                    </div>
                </div>
                <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-6">                    
                    <div class="pull-right">                        
                        <table class="cart-totals">							
                            <tr class="cart-grand-total">
                                <td><b>Total</b></td>
                                <td><b><?php echo number_format($_SESSION['total'], 2, ',', '.'); ?></b></td>
                            </tr>
                        </table>
                        <div class="pull-right">
                            <a href="index.php?idusuario=<?php echo $_SESSION['idusuario']; ?>" class="btn btn-grey"><i class="glyphicon glyphicon-shopping-cart"></i> CONTINUAR</a>
                            <a href="pagseguro.php?comprador=<?php echo $_SESSION['nome']?>&email=<?php echo $_SESSION['email']; ?>&valor=<?php echo number_format($_SESSION['total'], 2, ',', '.'); ?>" class="btn" target="_blank"><i class="glyphicon glyphicon-ok icon-white"></i> FINALIZAR</a>                        
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once 'rodape.php'; ?>
</body>
</html>