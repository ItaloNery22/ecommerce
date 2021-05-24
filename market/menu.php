<div class="mainmenu-wrapper">
    <div class="container">
        <div class="menuextras">
            <div class="extras">
                <ul>                        
                    <li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i>
                        <?php
                        // verificar a sessao qtditem
                        if ($_SESSION['qtditem'] != '') {
                            ?>
                            <a href="carrinho.php"><b>Carrinho</b></a>
                            <?php
                            echo $_SESSION['qtditem'];
                        } else {
                            ?>
                            <a><b>Carrinho</b></a>
                            <?php
                        }
                        ?>
                    </li>
                    <?php
                    // verificar a sessao idusuario
                    if ($_SESSION['idusuario'] != '') {
                        ?>
                        <li><?php echo $_SESSION['nome']; ?></li>
                        <li><a href="index.php?idusuario=0">sair</a></li>                                                        
                        <?php
                    } else {
                        $_SESSION['idproduto'] = '';
                        ?>
                        <li><a href="../login/index.php">login</a></li>                            
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <nav id="mainmenu" class="mainmenu">
            <ul>    
                <li class="logo-wrapper"><a href="#"><img src="img/logo.jpg" width="150px" height="70px"></a></li>
                <li>
                    <?php
                    // verificar a sessao idusuario
                    if ($_SESSION['idusuario'] != '') {
                        ?>
                        <a href="index.php?idusuario=<?php echo $_SESSION['idusuario']; ?>">Home</a>                                                        
                        <?php
                    } else {
                        ?>
                        <a href="index.php?idusuario=0">Home</a>                            
                        <?php
                    }
                    ?>
                </li>						
            </ul>
        </nav>
    </div>
</div>