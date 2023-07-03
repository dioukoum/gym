<?php
require 'connexion.php';
$_POST['title'] = 'Admin';
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $req = $db->prepare('insert into gerant(nom,prenom,login,password) values(?,?,?,?)');
    $req->bindValue(1, $nom);
    $req->bindValue(2, $prenom);
    $req->bindValue(3, $login);
    $req->bindValue(4, $password);
    $req->execute();
    header('Location: listeGerant.php');
}

//modification
if (isset($_GET['idm'])) {
    $req = $db->query('select * from gerant where id=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['nom'] = $ligne['nom'];
        $_POST['prenom'] = $ligne['prenom'];
        $_POST['login'] = $ligne['login'];
        $_POST['password'] = $ligne['password'];
    }
}

include 'header.php';
?>

<div class="col-xl container">
    <div class="card mt-4 mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Administrateur</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="ajouterGerant.php">
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Nom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Prenom</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Prenom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="prenom" value="<?php if (isset($_POST['prenom'])) echo $_POST['prenom']; ?>" />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Login</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="text" id="basic-icon-default-email" class="form-control" placeholder="Login" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="login" value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>" />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Password</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="password" id="basic-icon-default-email" class="form-control" placeholder="password" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" />
                    </div>
                </div>

                <?php if (isset($_GET['idm'])) : ?>
                    <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
                <?php endif ?>

                <?php if (!isset($_GET['idm'])) : ?>
                    <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>