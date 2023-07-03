<?php
require 'connexion.php';
$_POST['title'] = 'Abonnement';
include 'header.php';
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
                        <input class="form-control" type="number" id="html5-number-input" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="montant" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="html5-date-input" class="form-label">Date Debut</label>
                    <div>
                        <input class="form-control" type="date" value="" id="html5-date-input" name="dateDebut" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="html5-date-input" class="form-label">Date Fin</label>
                    <div>
                        <input class="form-control" type="date" value="" id="html5-date-input" name="dateFin" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>