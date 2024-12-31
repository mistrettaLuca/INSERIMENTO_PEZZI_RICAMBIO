<?php
include '../config.php';

function convertiMaiuscolo($stringa) {
    return strtoupper($stringa);
}

// Controllo se i dati sono stati inviati tramite POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $quantita = $_POST['quantita'];
    $dataAcquisto = $_POST['dataAcquisto'];
    
    // Verifica che idRicambioElettrico sia stato inviato e non sia vuoto
    $idRicambioElettrico = isset($_POST['idRicambioElettrico']) ? (int)$_POST['idRicambioElettrico'] : null;
    
    $idAmbiente = $_POST['idAmbiente'];
    $note = mysqli_real_escape_string($conn, $_POST['note']);

    // Se il valore di idRicambioElettrico è nullo o non valido, mostra un errore
    if ($idRicambioElettrico === null) {
        echo "Errore: il tipo di ricambio elettrico non è stato selezionato correttamente.";
        exit;
    }
    
    $nome = convertiMaiuscolo($_POST["nome"]);
    $quantita = convertiMaiuscolo($_POST["quantita"]);
    $dataAcquisto = convertiMaiuscolo($_POST["dataAcquisto"]);
    $idRicambioElettrico = convertiMaiuscolo($_POST["idRicambioElettrico"]);
    $idAmbiente = convertiMaiuscolo($_POST["idAmbiente"]);
    $note = convertiMaiuscolo($_POST["note"]);

    // Prepara la query di aggiornamento
    $query = "UPDATE pezzi_ricambio 
              SET nome = '$nome', 
                  quantita = '$quantita', 
                  dataAcquisto = '$dataAcquisto', 
                  idRicambioElettrico = $idRicambioElettrico, 
                  idAmbiente = '$idAmbiente', 
                  note = '$note' 
              WHERE IDPezziRicambio = '$id'";

    // Esegui la query
    if (mysqli_query($conn, $query)) {
        header("Location: visualizzaPezz.php?result=success");
    } else {
        // In caso di errore nell'esecuzione della query
        echo "Errore durante l'aggiornamento del pezzo di ricambio: " . mysqli_error($conn);
    }
} else {
    header("Location: visualizzaPezz.php?result=error");
}

mysqli_close($conn); // Chiudi la connessione al database
?>