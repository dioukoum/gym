<?php
require 'connexion.php';
$_POST['title'] = 'Abonnement';
if (isset($_POST['enregistrer'])) {
    $montant = $_POST['montant'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $req = $db->prepare('insert into Abonnement(montant,dateDebut,dateFin) values(?,?,?)');
    $req->bindValue(1, $montant);
    $req->bindValue(2, $dateDebut);
    $req->bindValue(3, $dateFin);
    $req->execute();
    header('Location: listeAbonnement.php');
}

//edition
if (isset($_GET['idm'])) {
    $req = $db->query('select * from abonnement where numeroAbonne=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['ida'] = $ligne['numeroAbonne'];
        $_POST['montant'] = $ligne['montant'];
        $_POST['dateDebut'] = $ligne['dateDebut'];
        $_POST['dateFin'] = $ligne['dateFin'];
    }
}

//modification
if (isset($_POST['modifier'])) {
    $req = $db->prepare('update abonnement set montant=?, dateDebut=?, dateFin=? where numeroAbonne=?');
    $req->bindValue(1, $_POST['montant']);
    $req->bindValue(2, $_POST['dateDebut']);
    $req->bindValue(3, $_POST['dateFin']);
    $req->bindValue(4, $_POST['ida']);
    $req->execute();
    header('Location: listeAbonnement.php');
}


include 'header.php';
?>

<div class="col-xl container">
    <div class="card mt-4 mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ajouter Abonnement</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="AjouterAbonnement.php">

                <div class="mb-3">
                    <label for="html5-number-input" class="form-label">Montant</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="number" id="html5-number-input" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="montant" required value="<?php if (isset($_POST['montant'])) echo $_POST['montant']; ?>" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="html5-date-input" class="form-label">Date Debut</label>
                    <div>
                        <input class="form-control" type="date" id="html5-date-input" name="dateDebut" required value="<?php if (isset($_POST['dateDebut'])) echo $_POST['dateDebut']; ?>" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="html5-date-input" class="form-label">Date Fin</label>
                    <div>
                        <input class="form-control" type="date" id="html5-date-input" name="dateFin" required value="<?php if (isset($_POST['dateFin'])) echo $_POST['dateFin']; ?>" />
                    </div>
                </div>

                <?php if (isset($_GET['idm'])) : ?>
                    <input type="hidden" name="ida" value="<?php if (isset($_POST['ida'])) echo $_POST['ida']; ?>">
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