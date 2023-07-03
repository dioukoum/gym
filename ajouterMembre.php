<?php
require 'connexion.php';
$_POST['title'] = 'Membres';
include 'header.php';
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $numeroAbonne = $_POST['numeroAbonne'];
    $req = $db->prepare('insert into membre(nom,prenom,telephone,login,password) values(?,?,?,?,?,?)');
    $req->bindValue(1, $nom);
    $req->bindValue(2, $prenom);
    $req->bindValue(3, $telephone);
    $req->bindValue(4, $login);
    $req->bindValue(5, $password);
    $req->execute();
    header('Location: listeMembre.php');
}
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
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Nom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="nom" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Prenom</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Prenom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="prenom" />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Login</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="text" id="basic-icon-default-email" class="form-control" placeholder="Login" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="login" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Password</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="password" id="basic-icon-default-email" class="form-control" placeholder="Password" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="password" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="70 40 04 00" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                    </div>
                </div>
                <div class="mt-2 mb-3">
                    <label for="largeSelect" class="form-label">Abonnement</label>
                    <select id="largeSelect" class="form-select form-select-lg" name="numeroAbonne">
                        <option>Abonnemet</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>