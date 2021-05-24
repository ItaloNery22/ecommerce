<?php
// criar sessao
session_start();

// inicializar todas as sessoes do usuario
$_SESSION['idusuario'] = '';
$_SESSION['nome'] = '';
$_SESSION['email'] = '';
$_SESSION['imagem'] = '';
$_SESSION['tipo'] = '';
?>
<html lang="pt">
    <head>
        <?php include_once 'cabecalho.php'; ?>
    </head>
    <body>
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Acesse o nosso site</h3>
                                        <p>Entre com o email e senha para acessar:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form action="login_process.php" method="post">
                                        <div class="form-group">
                                            <label class="sr-only">Email</label>
                                            <input type="text" name="email" placeholder="Email..." class="form-username form-control" required="true" />
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only">Senha</label>
                                            <input type="password" name="senha" placeholder="Senha..." class="form-password form-control" required="true" />
                                        </div>
                                        <button type="submit" class="btn">Entrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Cadastrar-se</h3>
                                        <p>Preencha o formulário abaixo para obter o acesso instantâneo:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form action="cadusuario_process.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="sr-only">Nome</label>
                                            <input type="text" name="nome" placeholder="Nome..." class="form-name form-control" required="true" />
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only">Email</label>
                                            <input type="text" name="email" placeholder="Email..." class="form-email form-control" required="true" />
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only">Senha</label>
                                            <input type="password" name="senha" placeholder="Senha..." class="form-password form-control" required="true" />
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only">Confirmar senha</label>
                                            <input type="password" name="confirmar_senha" placeholder="Confirmar senha..." class="form-confirm_password form-control" required="true" />
                                        </div>  
                                        <div class="form-group">
                                            <p>Photo</p>
                                            <input type="file" name="imagem" class="form-photo form-control" required="true" />
                                        </div> 
                                        <button type="submit" class="btn">Enviar</button>
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