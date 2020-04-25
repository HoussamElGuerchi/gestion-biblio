<?php
    include("header.php");
    include("config/db.php");
    session_start();

    $empnum = uniqid();
    $empdate = date("Y-m-d");
    $empdateret = date("Y-m-d", strtotime($empdate. " + 5 days"));;
    $lecnum = $_SESSION['lecnum'];
    $livcode = $_GET['livcode'];

    try {
        $stmt = $conn->prepare("insert into emprunts values('$empnum','$empdate','$empdateret','$livcode','$lecnum')");
        $stmt->execute();
        $conn->query("update livres set livdejareserve = 1 where livcode = '$livcode'");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>

    <div class="container p-5">
        <h1>Confirmation de réservation</h1>
        <p>Votre réservation est confirmé sous e numéro: <?php echo $empnum; ?><br>
        Date de la réservation: <?php echo $empdate; ?><br>
        Date du retour: <?php echo $empdateret; ?><br>
        Revenir à la liste des livres disponible en cliquant <a href="acceuil.php">ici</a>
        </p>

    </div>

<?php
    include("footer.php");
?>