<?php
$bucket = "bucket-padaria";
$foto_antiga = $_GET['foto'];
$dados = explode('_R', pathinfo($foto_antiga, PATHINFO_FILENAME));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_nome = preg_replace('/[^a-zA-Z0-9]/', '_', $_POST['item']);
    $novo_preco = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $_POST['preco']));
    $foto_nova = $novo_nome . "_R" . $novo_preco . "." . pathinfo($foto_antiga, PATHINFO_EXTENSION);

    shell_exec("/usr/local/bin/aws s3 cp s3://$bucket/fotos/$foto_antiga s3://$bucket/fotos/$foto_nova");
    shell_exec("/usr/local/bin/aws s3 rm s3://$bucket/fotos/$foto_antiga");
    header("Location: lista.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Editar</title></head>
<body style="font-family:sans-serif; text-align:center; background:#fff5e6; padding-top:50px;">
    <form method="POST" style="background:white; display:inline-block; padding:20px; border-radius:10px;">
        <h2>Editar Produto</h2>
        <input type="text" name="item" value="<?php echo str_replace('_', ' ', $dados[0]); ?>"><br><br>
        <input type="text" name="preco" value="<?php echo $dados[1]; ?>"><br><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
