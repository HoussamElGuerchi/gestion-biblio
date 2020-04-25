<?php
    include("header.php");
    include("config/db.php");

    session_start();
    if (!isset($_SESSION['lecnum'])) {
        header('Location: gestion-lecteur.php');
    } else {
        $lecnum = $_SESSION['lecnum'];
    }

    try {
        $stmt = $conn->prepare("select * from livres where livdejareserve = 0");
        $stmt->execute();

        $stmtUtilis = $conn->prepare("select * from lecteurs where lecnum = '$lecnum'");
        $stmtUtilis->execute();

        $stmtReserv = $conn->prepare("select * from livres join emprunts on emprunts.empcodelivre = livres.livcode join lecteurs on lecteurs.livcode = emprunts.empnumlect");
        $stmtReserv->execute();

        $livres = $stmt->fetchAll();
        $utilis = $stmtUtilis->fetch();
        $reservations = $stmtReserv->fetchAll();

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

?>

    <div class="container mt-5">
        <h1>Gestion du lecteur</h1>
        <p>Le lecteur <?php echo $utilis['lecnom']; ?> est reconnu.</p>

        <h5 class="mt-5">Liste des ouvrages disponibles à la réservation.</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Code Livre</th>
                    <th>Nom auteur</th>
                    <th>Prenom auteur</th>
                    <th>Titre</th>
                    <th>Categorie</th>
                    <th colspan="2">ISBN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($livres as $livre): ?>
                    <tr>
                        <td><?php echo $livre['livcode']; ?></td>
                        <td><?php echo $livre['livnomaut']; ?></td>
                        <td><?php echo $livre['livprenomaut']; ?></td>
                        <td><?php echo $livre['livtitre']; ?></td>
                        <td><?php echo $livre['livcategorie']; ?></td>
                        <td><?php echo $livre['livISBN']; ?></td>
                        <td><a href="reserver.php?code=<?php echo $livre['livcode']; ?>">Réserver</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h5 class="mt-5">Liste des vos réservations.</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Code Livre</th>
                    <th>Nom auteur</th>
                    <th>Prenom auteur</th>
                    <th>Titre</th>
                    <th>Categorie</th>
                    <th>ISBN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $res): ?>
                    <tr>
                        <td><?php echo $res['livcode']; ?></td>
                        <td><?php echo $res['livnomaut']; ?></td>
                        <td><?php echo $res['livprenomaut']; ?></td>
                        <td><?php echo $res['livtitre']; ?></td>
                        <td><?php echo $res['livcategorie']; ?></td>
                        <td><?php echo $res['livISBN']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
    include("footer.php");
?>