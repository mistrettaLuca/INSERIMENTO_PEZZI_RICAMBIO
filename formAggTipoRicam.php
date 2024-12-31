<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estForm.css">
    <title>Form Aggiungi Tipologia di pezzo di ricambio nel database</title>
</head>
<body>
<?php


if(isset($_GET['result'])){
    if($_GET['result'] =="success" )  {
      echo "Caricato con successo";
    }else{
      echo "Fallito";
    }
}

?>
    <h2>Inserisci la nuova tipologia di pezzo di ricambio nel database</h2>
    
    <form action="inserimentoAggTipoRicam.php" method="POST">
        <label for="tipo">Nuovo Tipo:</label>
        <input type="text" id="tipo" name="tipo" maxlength="40" required><br><br>
        <button style="border-radius: 100px; background-color: #ADD8E6; width: 30%; margin-left: 60%; font-size: 20px;" type="submit">Inserisci</button>
    </form>
    
    <button style="border-radius: 100px; background-color: #ADD8E6; width: 15%; font-size: 14px;"  onclick="window.location.href='formPezz.php'">Torna all'insermento pezzi di ricambio</button>
    
    <button style="border-radius: 100px; background-color: #ADD8E6; width: 15%; font-size: 14px;"  onclick="window.location.href='visualizzaTipologiePezz.php'">Visualizza le tipologie di pezzi di ricambio già presenti</button>
    


</body>
</html>