<?php
// criar sessao
session_start();

// criar conexao com o banco de dados mysql
include_once '../conexao/conexao.php';

if (isset($_SESSION['seq'])) {
    // criar variavel com a sequecia dos itens
    $seq = $_SESSION['seq'];
    $seq = intval($seq) + 1;
} else {
    $seq = 0;
}

// verificar se idproduto foi enviado pela url
if (isset($_GET['idproduto'])) {
    // criar variavel com o valor do idproduto
    $idproduto = $_GET['idproduto'];
    // criar sessao com o valor do idproduto
    $_SESSION['idproduto'] = $_GET['idproduto'];
}

// criar variavel com o comando sql para retornar o produto com o id enviado pela url
$sql = "select * from tbproduto where id = '$idproduto'";
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
                    <h1>Detalhes do Produto</h1>
                </div>
            </div>
        </div>
    </div>

    <?php
    // verificar se o retorno voltou algum produto
    if ($result->num_rows > 0) {
        // repetir ate o ultimo produto
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-image-large">
                                <img src="../adm/uploads/<?php echo $row['imagem']; ?>" alt="Item Name" width="250px" height="150px">
                            </div>                            
                        </div>

                        <div class="col-sm-6 product-details">
                            <h4><?php echo $row['nome']; ?></h4>
                            <div class="price">
                                <?php echo number_format($row['preco'], 2, ',', '.'); ?>
                            </div>
                            <form method="get" action="carrinho.php">
                                <input type="hidden" name="seq" value="<?php echo $seq; ?>">
                                <table class="shop-item-selections">                                                                
                                    <tr>
                                        <td><b>Quantidade:</b></td>
                                        <td>
                                            <input type="hidden" name="idproduto" class="form-control input-sm input-micro" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="preco" class="form-control input-sm input-micro" value="<?php echo $row['preco']; ?>">
                                            <input type="text" name="qtd" class="form-control input-sm input-micro" value="1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <input type="submit" class="btn btn-small" value="Adicionar ao carrinho">                                            
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                        <div class="col-sm-12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs product-details-nav">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Detalhes</a></li>
                                </ul>
                                <div class="tab-content product-detail-info">
                                    <div class="tab-pane active" id="tab1">
                                        <h4>Descrição do Produto</h4>
                                        <p>
                                            <?php echo $row['detalhes']; ?>
                                        </p>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <?php include_once 'rodape.php'; ?>
</body>
</html>