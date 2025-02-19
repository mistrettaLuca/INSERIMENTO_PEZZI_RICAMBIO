<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="templateVisualizzaDisp.css">
    <title>Visualizza Pezzi di Ricambio</title>
    <style>
        /* Stile per la colonna note */
        .note-cell {
            max-width: 200px; /* Larghezza massima della cella */
            overflow-x: auto; /* Abilita lo scorrimento orizzontale */
            white-space: nowrap; /* Impedisce il testo di andare a capo */
        }
    </style>
</head>
<body>

<h2>Elenco Pezzi di Ricambio</h2>

<?php
// Query per ottenere i dati dalla tabella pezzi_ricambio e unire con componenti_elettrici e ambienti
$query = "
    SELECT 
        pezzi_ricambio.IDPezziRicambio,
        pezzi_ricambio.nome AS nome,
        pezzi_ricambio.quantita,
        pezzi_ricambio.dataAcquisto,
        ricambi_elettrici.tipo AS tipo,
        ambienti.nome AS ambiente,
        pezzi_ricambio.note
    FROM 
        pezzi_ricambio
    INNER JOIN 
        ricambi_elettrici ON pezzi_ricambio.idRicambioElettrico = ricambi_elettrici.IDRicambioElettrico
    INNER JOIN 
        ambienti ON pezzi_ricambio.idAmbiente = ambienti.IDAmbiente
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Stampa i dati in una tabella
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID Pezzo</th>
            <th>Nome Pezzo</th>
            <th>Quantità</th>
            <th>Data Acquisto</th>
            <th>Tipo</th>
            <th>Aula</th>
            <th>Note</th>
            <th>Azioni</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['IDPezziRicambio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantita']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dataAcquisto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ambiente']) . "</td>";
        
        // Cella note con scorrimento laterale
        echo "<td class='note-cell'>" . htmlspecialchars($row['note']) . "</td>";

        // Colonna Azioni: Modifica ed Elimina
        echo "<td>
                <a href='modificaPezzo.php?id=" . $row['IDPezziRicambio'] . "'>Modifica</a> | 
                <a href='eliminaPezzo.php?id=" . $row['IDPezziRicambio'] . "' onclick='return confirm(\"Sei sicuro di voler eliminare questo pezzo di ricambio?\")'>Elimina</a>
              </td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nessun pezzo di ricambio trovato.</p>";
}
?>

<!-- Pulsante per tornare alla pagina di inserimento -->
<button style="border-radius: 100px; background-color: #ADD8E6; width: 20%; font-size: 18px;" onclick="window.location.href='formPezz.php'">Torna ad inserimento nuovo pezzo</button>

</body>
</html>