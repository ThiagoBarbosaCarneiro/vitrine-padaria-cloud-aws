<?php
$bucket = "bucket-padaria";
$local_path = "/var/www/html/fotos/";
shell_exec("/usr/local/bin/aws s3 sync s3://$bucket/fotos/ $local_path --delete");

if (isset($_GET['delete'])) {
    $foto_del = $_GET['delete'];
    shell_exec("/usr/local/bin/aws s3 rm s3://$bucket/fotos/$foto_del");
    header("Location: lista.php");
}
$fotos = array_diff(scandir($local_path), array('.', '..'));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Vitrine da Padaria</title>
    <style>
        body { font-family: sans-serif; background: #fffaf0; padding: 40px; }
        .vitrine { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; }
        .item-card { background: white; width: 220px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center; border-top: 5px solid #d2691e; }
        .item-card img { width: 100%; height: 160px; object-fit: cover; }
        .info { padding: 15px; }
        .nome { font-weight: bold; color: #333; }
        .preco { color: #d2691e; font-size: 1.2em; font-weight: bold; }
    </style>
</head>
<body>
    <h1 style="text-align:center; color:#8b4513;">🥐 Vitrine Cloud</h1>
    <div class="vitrine">
        <?php foreach ($fotos as $foto): 
            $dados = explode('_R', pathinfo($foto, PATHINFO_FILENAME));
            $nome = str_replace('_', ' ', $dados[0]);
            $valor = "R$ " . number_format((float)$dados[1], 2, ',', '.');
        ?>
            <div class="item-card">
                <img src="fotos/<?php echo $foto; ?>">
                <div class="info">
                    <div class="nome"><?php echo $nome; ?></div>
                    <div class="preco"><?php echo $valor; ?></div>
                    <a href="editar.php?foto=<?php echo $foto; ?>" style="font-size:12px; color:orange;">Editar</a> | 
                    <a href="?delete=<?php echo $foto; ?>" style="font-size:12px; color:red;">Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top:20px;"><a href="index.php">Cadastrar Novo</a></div>
</body>
</html>
