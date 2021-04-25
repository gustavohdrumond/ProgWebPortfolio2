<?php 
include_once "server/serve.php";

$Server = new Server();

$Listar = $Server->listarDados('acervo');
$ListarEditora = $Server->listarDados('editora');

$_REQUEST['Listar'] = $Listar;
$_REQUEST['ListarEditora'] = $Listar;

if(isset($_GET['acao'])){
    $acao = $_GET['acao'];
    $Server->$acao();
}

$Tipo = array(
    1 => 'Livro',
    2 => 'Catalogo',
    3 => 'Artigo',
    4 => 'Dissertação',
    5 => 'Folheto'
);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Livraria Online</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="assets/script.js" ></script>
    </head>
    <body>
        <div class="Header" style="background: red; padding: 10px 0 10px 0; margin: 0; " >
            <h1 style="color: yellow; margin-left: 10px;" >MEQUILIVROS</h1>
        </div>
        <div class="Content" >
            <!-- PESQUISAR -->
            <input id="myInput" type="text" placeholder="Pesquisar">
            <br />
            <br />
            <!-- LISTAR -->
            <table width="100%" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÍTULO</th>
                        <th>EDITORA</th>
                        <th>AUTOR</th>
                        <th>ANO</th>
                        <th>TIPO</th>
                        <th>PREÇO</th>
                        <th>QUANTIDADE</th>
                        <th>AÇÃO</th>
                    </tr>
                </thead>
                <tbody id="myTable" >
                    <?php foreach($Listar as $item) { ?>
                    <tr>
                        <td><?php echo $item->id; ?></td>
                        <td><?php echo $item->titulo; ?></td>
                        <td><?php echo isset($item->nome_editora) ? $item->nome_editora : "Sem editora"; ?></td>
                        <td><?php echo $item->autor; ?></td>
                        <td><?php echo $item->ano; ?></td>
                        <td><?php echo $Tipo[$item->tipo]; ?></td>
                        <td><?php echo $item->preco; ?></td>
                        <td><?php echo $item->quantidade; ?></td>
                        <td>
                            <a class="btn" onclick="Alterar(<?php echo $item->id; ?>)" >ALTERAR</a>
                            <a class="btn" onclick="Excluir(<?php echo $item->id; ?>)" >EXCLUÍR</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- SALVAR DADOS -->
            <div>
                <br />
                <fieldset>
                    <legend>INCLUSÃO / ALTERAÇÃO DE DADOS</legend>
                    <?php
                        $uri = explode('?', $_SERVER['REQUEST_URI']);
                        $link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$uri[0];
                    ?>
                    <form action="<?php echo $link.'?acao=SalvarRegistro';?>" method="POST" id="Form" >
                        <div class="campos" >
                            <label>Título</label><br />
                            <input id="id" name="id" type="hidden" />
                            <input id="titulo" name="titulo" type="text" placeholder="Escreva um título" />
                        </div>
                        <div class="campos" >
                            <label>Editora</label><br />
                            <select id="id_editora" name="id_editora" type="text" >
                                <?php foreach($ListarEditora as $item) { ?>
                                <option value="<?php echo $item->id_editora; ?>" ><?php echo $item->nome_editora; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="campos" >
                            <label>Autor</label><br />
                            <input id="autor" name="autor" type="text" placeholder="Escreva um autor" />
                        </div>
                        <div class="campos" >
                            <label>Ano</label><br />
                            <input id="ano" name="ano" type="text" placeholder="Escreva um ano" />
                        </div>
                        <div class="campos" >
                            <label>Tipo</label><br />
                            <select id="tipo" name="tipo" type="text" >
                                <option value="1" >Livro</option>
                                <option value="2" >Catalogo</option>
                                <option value="3" >Artigo</option>
                                <option value="4" >Dissertação</option>
                                <option value="5" >Folheto</option>
                            </select>
                        </div>
                        <div class="campos" >
                            <label>Preço</label><br />
                            <input id="preco" name="preco" type="text" placeholder="Digite um preço" />
                        </div>
                        <div class="campos" >
                            <label>Quantidade</label><br />
                            <input id="quantidade" name="quantidade" type="text" placeholder="Digite uma quantidade" />
                        </div>
                        <div class="campos" >
                            <button type="button" onclick="$('#Form').submit()" > Salvar </button>
                            <button type="button" onclick="window.location = window.location.href" > Resetar </button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </body>
</html