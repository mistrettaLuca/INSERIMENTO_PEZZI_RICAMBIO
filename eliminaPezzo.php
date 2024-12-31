<?php
include '../config.php';

// Verifica se l'ID del pezzo di ricambio è passato tramite URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara la query per eliminare il pezzo di ricambio
    $query = "DELETE FROM pezzi_ricambio WHERE IDPezziRicambio = '$id'";

    // Esegui la query
    if (mysqli_query($conn, $query)) {
        // Se l'eliminazione ha avuto successo, reindirizza con il risultato "success"
        header("Location: visualizzaPezz.php?result=success");
    } else {
        // Se c'è stato un errore, mostra il messaggio di errore
        echo "Errore durante l'eliminazione del pezzo di ricambio: " . mysqli_error($conn);
    }
} else {
    // Se l'ID non è stato passato, reindirizza alla pagina di visualizzazione con errore
    header("Location: visualizzaPezz.php?result=error");
}

mysqli_close($conn); // Chiudi la connessione al database
?>