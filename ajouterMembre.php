<?php
require 'connexion.php';
$_POST['title'] = 'Membres';
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $numeroAbonne = $_POST['numeroAbonne'];
    $req = $db->prepare('insert into membre(nom,prenom,telephone,login,password,numeroAbonne) values(?,?,?,?,?,?)');
    $req->bindValue(1, $nom);
    $req->bindValue(2, $prenom);
    $req->bindValue(3, $telephone);
    $req->bindValue(4, $login);
    $req->bindValue(5, $password);
    $req->bindValue(6, $numeroAbonne);
    $req->execute();
    header('Location: listeMembre.php');
}

//edition
if (isset($_GET['idm'])) {
    $req = $db->query('select * from membre where id=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['id'] = $ligne['id'];
        $_POST['nom'] = $ligne['nom'];
        $_POST['prenom'] = $ligne['prenom'];
        $_POST['telephone'] = $ligne['telephone'];
        $_POST['login'] = $ligne['login'];
        $_POST['password'] = $ligne['password'];
        $_POST['numeroAbonne'] = $ligne['numeroAbonne'];
    }
}

//modification
if (isset($_POST['modifier'])) {
    $req = $db->prepare('update membre set nom=?, prenom=?, telephone=?,login=?, password=?, numeroAbonne=? where id=?');
    $req->bindValue(1, $_POST['nom']);
    $req->bindValue(2, $_POST['prenom']);
    $req->bindValue(3, $_POST['telephone']);
    $req->bindValue(4, $_POST['login']);
    $req->bindValue(5, $_POST['password']);
    $req->bindValue(6, $_POST['numeroAbonne']);
    $req->bindValue(7, $_POST['id']);
    $req->execute();
    header('Location: listeMembre.php');
}

include 'header.php';
?>

<div class="col-xl container">
    <div class="card mt-4 mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ajouter Membre</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="ajouterMembre.php">
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
                        <input type="password" id="basic-icon-default-email" class="form-control" placeholder="Password" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="70 40 04 00" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" name="telephone" value="<?php if (isset($_POST['telephone'])) echo $_POST['telephone']; ?>" />
                    </div>
                </div>
                <div class="mt-2 mb-3">
                    <label for="largeSelect" class="form-label">Abonnement</label>
                    <select id="largeSelect" class="form-select form-select-lg" name="numeroAbonne">
                        <option></option>
                        <?php
                        $req = $db->query('select * from abonnement');
                        while ($ligne = $req->fetch()) : ?>
                            <option value="<?= $ligne['numeroAbonne'] ?>" selected>
                                Du <?= $ligne['dateDebut'] ?> au <?= $ligne['dateFin'] ?>
                            </option>
                        <?php endwhile ?>
                    </select>
                </div>
                <?php if (isset($_GET['idm'])) : ?>
                    <input type="hidden" name="id" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>">
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