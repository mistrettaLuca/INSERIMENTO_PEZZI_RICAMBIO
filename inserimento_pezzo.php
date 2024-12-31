<?php
// Connessione al database
include '../config.php';

function convertiMaiuscolo($stringa) {
    return strtoupper($stringa);
}

// Verifica se i dati sono stati inviati tramite POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantita = $_POST['quantita'];
    $dataAcquisto = $_POST['dataAcquisto'];
    $idRicambioElettrico = $_POST['idRicambioElettrico'];
    $idAmbiente = $_POST['idAmbiente'];
    $note = $_POST['note'];

var_dump($_POST);

    $err=false;
    
    $nome = convertiMaiuscolo($_POST["nome"]);
    $quantita = convertiMaiuscolo($_POST["quantita"]);
    $dataAcquisto = convertiMaiuscolo($_POST["dataAcquisto"]);
    $idRicambioElettrico = convertiMaiuscolo($_POST["idRicambioElettrico"]);
    $idAmbiente = convertiMaiuscolo($_POST["idAmbiente"]);
    $note = convertiMaiuscolo($_POST["note"]);

    // Query per inserire i dati nel database
    if(!$err){
        $query = "INSERT INTO pezzi_ricambio (nome, quantita, dataAcquisto, idRicambioElettrico, idAmbiente, note) 
            VALUES ('$nome', '$quantita', '$dataAcquisto', '$idRicambioElettrico', '$idAmbiente', '$note');";
        
        if ($conn->query($query) === TRUE) {
                // Se la query è riuscita, reindirizza con 'success'
                header("Location: formPezz.php?result=success");
            } else {
                // Se c'è stato un errore, reindirizza con 'fail'
                header("Location: formPezz.php?result=fail");
            }
            exit();  // Assicurati che lo script termini per evitare ulteriori output
    }
}
?>