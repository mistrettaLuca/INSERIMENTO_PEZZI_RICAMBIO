<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Recupero i dati del pezzo di ricambio dalla tabella
    $query = "SELECT * FROM pezzi_ricambio WHERE IDPezziRicambio = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

// Recupero i dati della tabella esterna (ricambi elettrici)
$componentQuery = "SELECT * FROM ricambi_elettrici";
$componentResult = mysqli_query($conn, $componentQuery);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estForm.css">
    <title>Modifica Pezzo di Ricambio</title>
</head>
<body>

<h2>Modifica Pezzo di Ricambio</h2>

<form action="updatePezz.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['IDPezziRicambio']; ?>">
    
    <label for="nome">Nome del Pezzo di Ricambio:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8'); ?>" maxlength="50" required><br><br>

    <label for="quantita">Quantità:</label>
    <input type="number" id="quantita" name="quantita" value="<?php echo htmlspecialchars($row['quantita'], ENT_QUOTES, 'UTF-8'); ?>" min="1" required><br><br>

    <label for="dataAcquisto">Data di Acquisto:</label>
    <input type="date" id="dataAcquisto" name="dataAcquisto" value="<?php echo htmlspecialchars($row['dataAcquisto'], ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <label for="idRicambioElettrico">Tipo:</label>
    <select name="idRicambioElettrico" required>
        <?php 
        // Popola la lista a discesa con i dati dalla tabella `ricambi_elettrici`
        while ($component = mysqli_fetch_assoc($componentResult)) { ?>
            <option value="<?php echo $component['IDRicambioElettrico']; ?>" 
                <?php echo ($row['idRicambioElettrico'] == $component['IDRicambioElettrico']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($component['tipo'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label for="idAmbiente">Aula:</label>
    <select name="idAmbiente" id="idAmbiente" required>
        <?php
        // Recupera i dati degli ambienti
        $query = "SELECT * FROM ambienti";
        $result = mysqli_query($conn, $query);
        while ($ambiente = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $ambiente['IDAmbiente'] . "' " . ($row['idAmbiente'] == $ambiente['IDAmbiente'] ? "selected" : "") . ">" . htmlspecialchars($ambiente['nome'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br><br>

    <label for="note">Note (opzionale):</label>
    <textarea id="note" name="note" maxlength="500"><?php echo htmlspecialchars($row['note'], ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>

    <input style="border-radius: 100px; background-color: #ADD8E6; width: 35%; margin-left: 60%; font-size: 15px;" type="submit" value="Modifica Pezzo di Ricambio">
</form>

<button style="border-radius: 100px; background-color: #ADD8E6; width: 30%; margin-right: 60%; font-size: 15px;"  onclick="window.location.href='visualizzaPezz.php'">Torna all'elenco dei pezzi di ricambio</button>

</body>
</html>