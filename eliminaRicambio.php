<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Query per eliminare la riga
    $query = "DELETE FROM ricambi_elettrici WHERE IDRicambioElettrico = $id";

    if (mysqli_query($conn, $query)) {
        // Reindirizza alla pagina principale dopo l'eliminazione
        header('Location: visualizzaTipologiePezz.php');
    } else {
        echo "Errore durante l'eliminazione: " . mysqli_error($conn);
    }

    // Chiudi la connessione
    mysqli_close($conn);
}
?>