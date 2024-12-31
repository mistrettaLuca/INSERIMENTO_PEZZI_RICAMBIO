<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estForm.css">
    <title>Inserimento Pezzo di Ricambio</title>
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

    <h2>Inserisci Pezzo di Ricambio</h2>
    
    <form action="inserimento_pezzo.php" method="POST">
        <label for="nome">*Nome del Pezzo di Ricambio:</label>
        <input type="text" id="nome" name="nome" maxlength="50" required><br><br>

        <label for="quantita">*Quantità:</label>
        <input type="number" id="quantita" name="quantita" min="1" required><br><br>

        <label for="dataAcquisto">Data di Acquisto:</label>
        <input type="date" id="dataAcquisto" name="dataAcquisto"><br><br>

        <label for="idRicambioeElettrico">*Tipo:</label>
        <select id="idRicambioElettrico" name="idRicambioElettrico" required>
            <?php
                $query="SELECT * FROM `ricambi_elettrici`";
                $result=mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    
                    echo "<option value='".$row['IDRicambioElettrico']."'>".$row['tipo']."</option>";
                    
                }
                ?>
        </select>
        <button style="border-radius: 150px; background-color: #ADD8E6; width: 4%; text-align: center;"  onclick="window.location.href='formAggTipoRicam.php'">+</button>

        <label for="idAmbiente">*Aula:</label>
        <select name="idAmbiente" id="idAmbiente">
            <?php
                $query="SELECT * FROM `ambienti`";
                $result=mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    
                    echo "<option value='".$row['IDAmbiente']."'>".$row['nome']."</option>";
                    
                }
                ?>
        </select><br><br>

        <label for="note">Note (opzionale):</label>
        <textarea id="note" name="note" maxlength="500"></textarea><br><br>

        <button style="border-radius: 100px; background-color: #ADD8E6; width: 35%; margin-left: 60%; font-size: 15px;" type="submit">Inserisci Pezzo di Ricambio</button>
    </form>
    <button style="border-radius: 100px; background-color: #ADD8E6; width: 20%; font-size: 18px;"  onclick="window.location.href='visualizzaPezz.php'">Visualizza i pezzi di ricambio già inseriti</button>
</body>
</html>