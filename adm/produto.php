<?php
include_once '../conexao/conexao.php';

$sql = "select * from tbproduto";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php include_once 'cabecalho.php'; ?>        
    </head>
    <body>
        <div id="wrapper">
            <?php include_once 'menu.php'; ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Produto</h1>                        
                        <a class="btn btn-primary" href="produto_cad.php" style="width: 150px;">Novo</a>                        
                        <br /><br />
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 30%;">Nome</th>
                                    <th style="width: 10%;">Qtd</th>
                                    <th style="width: 20%;">Preço</th>                                    
                                    <th style="width: 20%;">Imagem</th>
                                    <th style="width: 10%;">Ação</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo number_format($row['qtd'], 2, ',', '.'); ?></td>
                                            <td><?php echo 'R$ ' . number_format($row['preco'], 2, ',', '.'); ?></td>                                            
                                            <td><?php echo $row['imagem']; ?></td>
                                            <td><a href="produto_cad.php?acao=editar&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" style="width: 60px;">Editar</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>

        <?php include_once 'rodape.php'; ?>
    </body>
</html>