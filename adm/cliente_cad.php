<?php
include_once '../conexao/conexao.php';

$id = '';
$nome = '';
$email = '';
$telefone = '';

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    if ($acao == 'editar') {
        $sql = "select * from tbcliente where id = " . $_GET['id'];

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $nome = $row['nome'];
            $email = $row['email'];
            $telefone = $row['telefone'];
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
                        <h1 class="page-header">Cliente</h1>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="cliente_cad_prc.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nome:</label>
                                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefone:</label>
                                            <input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>">
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
