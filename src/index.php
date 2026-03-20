<?php
$bucket = "bucket-padaria"; 
$diretorio_local = "/var/www/html/fotos/";
if (!is_dir($diretorio_local)) { mkdir($diretorio_local, 0777, true); }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $item = preg_replace('/[^a-zA-Z0-9]/', '_', $_POST['item']);
    $preco = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $_POST['preco']));
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nome_final = $item . "_R" . $preco . "." . $ext;
    $caminho_final = $diretorio_local . $nome_final;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_final)) {
        shell_exec("/usr/local/bin/aws s3 cp $caminho_final s3://$bucket/fotos/$nome_final 2>&1");
        $status = "✅ Item '$item' adicionado!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Padaria</title>
    <style>
        body { font-family: sans-serif; background: #fff5e6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); width: 320px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #d2691e; color: white; border: none; cursor: pointer; font-weight: bold; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🥖 Novo Item</h2>
        <?php if(isset($status)) echo "<p>$status</p>"; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="item" placeholder="Nome do Produto" required>
            <input type="text" name="preco" placeholder="Preço (Ex: 5.50)" required>
            <input type="file" name="foto" required>
            <button type="submit">Adicionar à Vitrine</button>
        </form>
        <a href="lista.php" style="display:block; margin-top:15px; color:#8b4513;">Ver Vitrine</a>
    </div>
</body>
</html>
