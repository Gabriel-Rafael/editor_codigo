
<?php 
    if(isset($_POST['acao'])){
        $texto =  $_POST['texto'];
        $arquivo = $_POST['arquivo'];
        file_put_contents($arquivo,$texto);
        echo '<script>alert("salvo")</script>';
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
</head>
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .lista-arquivo-single{
        background: #000000;
        padding: 10px;
        border-bottom: 3px solid #40A2D8;
        color: white;
        cursor: pointer;
    }

    .lista-arquivo-single:hover{
        background: #0B60B0;
    }
</style>
<body>
    <?php 
        $files = scandir('files');
        for ($i=0; $i < count($files); $i++) { 
            if(is_dir($files[$i]))
                continue;
            $file_extension = explode('.',$files[$i]);
            if(@$file_extension[1] == 'php' || @$file_extension[1] == 'html' || @$file_extension[1] == 'js'){
?>
    <div class="lista-arquivo-single">
        <p><a href="?file=<?php echo $files[$i]; ?>"><?php echo $files[$i]; ?></a></p>
    </div><!--lista-->
<?php
            }    
        }

        if(isset($_GET['file']) && file_exists('files/'.$_GET['file'])){
?>
    <h2><?php echo 'editando arquivo:'.$_GET['file']; ?></h2>
    <form method="post">
        <textarea name="texto" style="width: 500px; height: 500px;"><?php echo file_get_contents('files/'.$_GET['file']) ?></textarea>
        <br>
        <input type="hidden" name="arquivo" value="<?php echo 'files/'.$_GET['file'] ?>">
        <input type="submit" name="acao" value="Salvar!">
    </form>
<?php } ?>
</body>
</html>