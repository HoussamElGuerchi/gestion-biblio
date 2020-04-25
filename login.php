<?php
    include("header.php");
    include("config/db.php");
    session_start();
?>

    <div class="container mt-5 p-5">
        <h1>Authentification d'un lecteur</h1>
        <form class="pr-5 mr-5" action="login.php" method="post">
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" name="pass" required>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>

            <?php
                if (isset($_POST["nom"]) && isset($_POST["pass"])) {
                    $nom = $_POST["nom"];
                    $pass = $_POST["pass"];

                    $stmt = $conn->prepare("select lecnum, lecnom, lecmotdepasse from lecteurs where lecnom='$nom' and lecmotdepasse='$pass'");
                    $stmt->execute();

                    $utilis = $stmt->fetch();
                    if ($utilis == null) {
                        echo "<div class='alert alert-danger mt-3' role='alert'>
                            Le nom ou le mot de passe est incorrecte.
                        </div>";
                    } else {
                        $_SESSION["lecnum"] = $utilis["lecnum"];
                        header("Location: acceuil.php");
                    }
                }
            ?>
        </form>
    </div>

<?php
    include("footer.php");
?>