<?php
include '../config.php';

function convertiMaiuscolo($stringa) {
    return strtoupper($stringa);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Recupera i dati del ricambio da modificare
    $query = "SELECT * FROM ricambi_elettrici WHERE IDRicambioElettrico = $id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form action="modificaRicambio.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['IDRicambioElettrico']; ?>">
            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" value="<?php echo $row['tipo']; ?>" required>
            <button type="submit">Salva modifiche</button>
        </form>
        <?php
    } else {
        echo "Ricambio non trovato.";
    }

    mysqli_close($conn);
} elseif (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
    
    $tipo = convertiMaiuscolo($tipo);

    // Query per aggiornare il ricambio
    $query = "UPDATE ricambi_elettrici SET tipo = '$tipo' WHERE IDRicambioElettrico = $id";

    if (mysqli_query($conn, $query)) {
        header('Location: visualizzaTipologiePezz.php');
    } else {
        echo "Errore durante la modifica: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>