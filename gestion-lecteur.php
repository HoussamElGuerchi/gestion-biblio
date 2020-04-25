<?php
    include("header.php");
    include("config/db.php");
    session_start();
?>

    <div class="container mt-5 p-5">
        <h1>Gestion Lecteur</h1>
        <p>Le lecteur n'est pas reconnu. <br>
        Cliquez <a href="login.php">ici</a> pour tenter un nouvelle identification.</p>

        <h3 class="mt-5">Enregistrement d'un lecteur</h3>
        <form action="landgestion-lecteur.php" method="post">
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="form-group">
                <label for="">Prenom</label>
                <input type="text" class="form-control" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="">Mot de Passe</label>
                <input type="password" class="form-control" name="pass" required>
            </div>
            <div class="form-group">
                <label for="">Adresse</label>
                <input type="text" class="form-control" name="adresse" required>
            </div>
            <div class="form-group">
                <label for="">Code Postal</label>
                <input type="text" class="form-control" name="codepost" required>
            </div>
            <div class="form-group">
                <label for="">Ville</label>
                <input type="text" class="form-control" name="ville" required>
            </div>
            <button class="btn btn-primary" type="submit" name="valider">Valider</button>
        </form>

        <?php
            if(isset($_POST['valider'])) {
                $lecnum = uniqid();
                $lecnom = $_POST['nom'];
                $lecprenom = $_POST['prenom'];
                $lecpass = $_POST['pass'];
                $lecadresse = $_POST['adresse'];
                $leccode = $_POST['codepost'];
                $lecville = $_POST['ville'];

                try {
                    $sql = "insert into lecteurs values('$lecnum','$lecnom','$lecprenom','$lecadresse','$lecville','$leccode','$lecpass')";
                    $conn->exec($sql);

                    $_SESSION["lecnum"] = $lecnum;

                    header("Location: acceuil.php");

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }
        ?>
    </div>

<?php
    include("footer.php");
?>