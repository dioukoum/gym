<?php
require 'connexion.php';
$_POST['title'] = 'Entraineur';
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $specialite = $_POST['specialite'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $req = $db->prepare('insert into entraineur(nom,prenom,specialite,login,password) values(?,?,?,?,?)');
    $req->bindValue(1, $nom);
    $req->bindValue(2, $prenom);
    $req->bindValue(3, $specialite);
    $req->bindValue(4, $login);
    $req->bindValue(5, $password);
    $req->execute();
    header('Location: listeEntraineur.php');
}

//edition
if (isset($_GET['idm'])) {
    $req = $db->query('select * from entraineur where idEnt=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['idEnt'] = $ligne['idEnt'];
        $_POST['nom'] = $ligne['nom'];
        $_POST['prenom'] = $ligne['prenom'];
        $_POST['specialite'] = $ligne['specialite'];
        $_POST['login'] = $ligne['login'];
        $_POST['password'] = $ligne['password'];
    }
}

//modification
if (isset($_POST['modifier'])) {
    $req = $db->prepare('update entraineur set nom=?, prenom=?, specialite=?,login=?, password=? where idEnt=?');
    $req->bindValue(1, $_POST['nom']);
    $req->bindValue(2, $_POST['prenom']);
    $req->bindValue(3, $_POST['specialite']);
    $req->bindValue(4, $_POST['login']);
    $req->bindValue(5, $_POST['password']);
    $req->bindValue(6, $_POST['idEnt']);
    $req->execute();
    header('Location: listeEntraineur.php');
}

include 'header.php';
?>

<div class="col-xl container">
    <div class="card mt-4 mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Entraineur</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="ajouterEntraineur.php">
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user-plus"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Nom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Prenom</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user-plus"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Prenom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="prenom" value="<?php if (isset($_POST['prenom'])) echo $_POST['prenom']; ?>" />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Spécialité</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user-plus"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Spécialité" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="specialite" value="<?php if (isset($_POST['specialite'])) echo $_POST['specialite']; ?>" />
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
                    <input type="hidden" name="idEnt" value="<?php if (isset($_POST['idEnt'])) echo $_POST['idEnt']; ?>">
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