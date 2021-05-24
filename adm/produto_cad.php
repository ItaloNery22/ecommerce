<?php
include_once '../conexao/conexao.php';

$id = '';
$nome = '';
$qtd = '';
$preco = '';
$imagem = '';
$detalhes = '';

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    if ($acao == 'editar') {
        $sql = "select * from tbproduto where id = " . $_GET['id'];

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $nome = $row['nome'];
            $qtd = number_format($row['qtd'], 2, ',', '.');
            $preco = number_format($row['preco'], 2, ',', '.');            
            $imagem = $row['imagem'];
            $detalhes = $row['detalhes'];
        }
    }
}
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

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="produto_cad_prc.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nome:</label>
                                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Qtd:</label>
                                            <input type="text" name="qtd" class="form-control" value="<?php echo $qtd; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Preço:</label>
                                            <input type="text" name="preco" class="form-control" value="<?php echo $preco; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Detalhes:</label>
                                            <textarea name="detalhes" cols="5" rows="10" class="form-control"><?php echo $detalhes; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Imagem:</label>
                                            <input type="file" name="imagem" class="form-control" value="<?php echo $imagem; ?>">
                                        </div>
                                        <div class="form-group">                                            
                                            <input type="submit" value="Enviar" class="form-control btn btn-success">
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>

        <?php include_once 'rodape.php'; ?>
    </body>
</html>
