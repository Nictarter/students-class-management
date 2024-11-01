<?php
	session_start();
	if (isset($_SESSION["logged"]) === false OR $_SESSION["logged"] === true) {
		include_once "includes/navBarHeader.inc.php";
	}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>3LOS4</title>
		<link rel="stylesheet" href="includes/main.css">
    </head>
    <body>
        <h1>Benvenuti nei Servizi LOS4!</h1>
		<div>
			<?php
				if ($_SESSION["logged"] === false) {
					echo '<div id="divLogin">';
                    echo '<form action="includes/login.inc.php" method="post">';
					echo '<input type="email" name="email" placeholder="Email" required>';
					echo '<br>';
					echo '<button>Accedi</button>';
					echo '</form>';
					echo '</div>';
                }
            ?>
        </div>
        <div class="orario">
            <h3 class="orario">Orario</h3>
            <table class="orario">
                <?php
                    try {
                        require_once "includes/connectDatabase.inc.php";
                        $query = "SELECT * FROM Orario_settimanale WHERE Giornata = '" . date('l') . "'";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                        while ($output = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo '<tr class="orario"><td colspan="2"><hr></td></tr>';
                            echo '<tr class="orario">';
                            echo '<td class="orario"><strong>' . strtoupper($output->Materia) . '</strong></td>';
                            echo '<td class="orario">'
                            echo '($output->Orario_inizio)[0]';
                            echo '($output->Orario_inizio)[1]';
                            echo '($output->Orario_inizio)[2]';
                            echo '($output->Orario_inizio)[3]';
                            echo '($output->Orario_inizio)[4]';
                            echo '<br>';
                            echo '($output->Orario_fine)[0]';
                            echo '($output->Orario_fine)[1]';
                            echo '($output->Orario_fine)[2]';
                            echo '($output->Orario_fine)[3]';
                            echo '($output->Orario_fine)[4]';
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '<tr class="orario"><td colspan="2"><hr></td></tr>';
                    } catch(PDOException $errore) {
                        die("La raccolta dei dati dal database è fallita: " . $errore)
                    }
                ?>
            </table>
        </div>
    </body>
</html>