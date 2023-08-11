<?php
$dir = __DIR__; // Substitua pelo caminho do diretório que você deseja listar

if (isset($_POST['delete_folder'])) {
    $folderToDelete = $_POST['folder_to_delete'];

    if (!empty($folderToDelete)) {
        $folderToDelete = $dir . '/' . $folderToDelete;

        if (is_dir($folderToDelete)) {
            if (rmdir($folderToDelete)) {
                echo "Pasta excluída com sucesso: $folderToDelete";
            } else {
                echo "Erro ao excluir a pasta: $folderToDelete";
            }
        } else {
            echo "Pasta não encontrada: $folderToDelete";
        }
    } else {
        echo "Nome da pasta inválido.";
    }
}

$folders = array_filter(glob($dir . '/*'), 'is_dir');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Excluir Pasta</title>
</head>
<body>
    <h2>Pastas no diretório:</h2>
    <ul>
        <?php foreach ($folders as $folder) {
            $folderName = basename($folder);
            echo "<li>$folderName <a href='?delete=$folderName'>Excluir</a></li>";
        } ?>
    </ul>

    <?php if (isset($_GET['delete'])) {
        $folderToDelete = $_GET['delete'];
        ?>
        <h3>Tem certeza que deseja excluir a pasta "<?php echo $folderToDelete; ?>"?</h3>
        <form method="post">
            <input type="hidden" name="folder_to_delete" value="<?php echo $folderToDelete; ?>">
            <input type="submit" name="delete_folder" value="Excluir">
        </form>
    <?php } ?>
</body>
</html>

