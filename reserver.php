<?php
    include("header.php");
    include("config/db.php");

    $livcode = $_GET['code'];

    try {
        $stmt = $conn->prepare("select * from livres where livcode = '$livcode'");
        $stmt->execute();

        $livre = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>

    <div class="container p-5">
        <h1>Réserver un livre</h1>
        <p>Vous désirez réserver le livre suivant :</p>
        <table class="table table-bordered">
            <tr>
                <th>Code du livre</th>
                <td><?php echo $livre['livcode']; ?></td>
            </tr>
            <tr>
                <th>Nom de l'auteur</th>
                <td><?php echo $livre['livnomaut']; ?></td>
            </tr>
            <tr>
                <th>Prenom de l'auteur</th>
                <td><?php echo $livre['livprenomaut']; ?></td>
            </tr>
            <tr>
                <th>Titre</th>
                <td><?php echo $livre['livtitre']; ?></td>
            </tr>
            <tr>
                <th>Categorie</th>
                <td><?php echo $livre['livcategorie']; ?></td>
            </tr>
            <tr>
                <th>ISBN</th>
                <td><?php echo $livre['livISBN']; ?></td>
            </tr>
        </table>
        <form action="confirm.php?livcode=<?php echo $livcode; ?>" method="post">
            <button class="btn btn-primary">Confirmer</button>
        </form>
    </div>

<?php
    include("footer.php");
?>