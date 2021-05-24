<?php
// criar sessao
session_start();

// criar conexao com o banco de dados mysql
include_once '../conexao/conexao.php';

// verificar se o idusuario foi enviado pela url
if (isset($_GET['idusuario'])) {
    // verificar se o valor do idusuario enviado foi 0
    if ($_GET['idusuario'] == 0) {
        // inicializar todas as sessoes
        $_SESSION['idusuario'] = '';
        $_SESSION['nome'] = '';
        $_SESSION['email'] = '';
        $_SESSION['imagem'] = '';
        $_SESSION['idproduto'] = '';
        $_SESSION['idvenda'] = '';
        $_SESSION['qtd'] = '';
        $_SESSION['preco'] = '';
        $_SESSION['total'] = '';
        $_SESSION['qtditem'] = '';
    }
    // inicializar todas as sessoes
} else {
    $_SESSION['idusuario'] = '';
    $_SESSION['nome'] = '';
    $_SESSION['email'] = '';
    $_SESSION['imagem'] = '';
    $_SESSION['idproduto'] = '';
    $_SESSION['idvenda'] = '';
    $_SESSION['qtd'] = '';
    $_SESSION['preco'] = '';
    $_SESSION['total'] = '';
    $_SESSION['qtditem'] = '';
}
// criar variavel com o comando sql para retornar todos os produtos
$sql = "select * from tbproduto";
// executar comando no banco de dados mysql
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<head>
    <?php include_once 'cabecalho.php'; ?>
</head>
<body>        
    <?php include_once 'menu.php'; ?>

    <div class="homepage-slider">
        <div id="sequence">
            <ul class="sequence-canvas">
                <li style="background-image: url(img/homepage-slider/slider-bg1.jpg);">
                    <h2 class="title">Medicamentos</h2>
                    <h3 class="subtitle">Genericos a seu alcançe!</h3>
                    <img class="slide-img" src="../adm/uploads/destaque1.png" width="500px" height="300px" alt="Slide 1" />
                </li>
                <li style="background-image: url(img/homepage-slider/slider-bg2.jpg);">
                    <h2 class="title">Qualidade</h2>
                    <h3 class="subtitle">Chega de Gripe!</h3>
                    <img class="slide-img" src="../adm/uploads/destaque2.png" width="500px" height="300px" alt="Slide 2" />
                </li>
                <li style="background-image: url(img/homepage-slider/slider-bg3.jpg);">
                    <h2 class="title">Preço baixo</h2>
                    <h3 class="subtitle">Garantida a satisfação do cliente!</h3>
                    <img class="slide-img" src="../adm/uploads/destaque3.png" alt="Slide 3" />
                </li>
            </ul>
            <div class="sequence-pagination-wrapper">
                <ul class="sequence-pagination">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="eshop-section section">
        <div class="container"> 
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    $fazLinha = 0;
                    while ($row = $result->fetch_assoc()) {
                        if ($fazLinha == 4) {							
                            ?>
                        </div> 
                        <div class="row">
                            <?php
                        }
						$fazLinha = 0;
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="shop-item">
                                <div class="shop-item-image">
                                    <center>
                                        <img src="../adm/uploads/<?php echo $row['imagem'] ?>" alt="Item Name" width="250px" height="150px">
                                    </center>
                                </div>
                                <div class="title">
                                    <h3>[<?php echo $row['nome']; ?>]</h3>
                                </div>                                
                                <div class="price">
                                    R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?>
                                </div>
                                <div class="actions">
                                    <a href="detalhes.php?idproduto=<?php echo $row['id']; ?>" class="btn btn-small"><i class="icon-shopping-cart icon-white"></i> Detalhes</a>
                                </div>
                            </div>                
                        </div>
                        <?php                        
                        $fazLinha++;
                    }
                }
                ?>                        
            </div>       
        </div>
    </div>

    <?php include_once 'rodape.php'; ?>
</body>
</html>