<?php
require 'connexion.php';
$_POST['title'] = 'Equipement';
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $disponibilite = $_POST['disponibilite'];
    $req = $db->prepare('insert into equipement(nom,quantite,disponibilite) values(?,?,?)');
    $req->bindValue(1, $nom);
    $req->bindValue(2, $quantite);
    $req->bindValue(3, $disponibilite);
    $req->execute();
    header('Location: listeEquipement.php');
}
//edition
if (isset($_GET['idm'])) {
    $req = $db->query('select * from equipement where ide=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['ide'] = $ligne['ide'];
        $_POST['nom'] = $ligne['nom'];
        $_POST['quantite'] = $ligne['quantite'];
        $_POST['disponibilite'] = $ligne['disponibilite'];
    }
}

//modification
if (isset($_POST['modifier'])) {
    $req = $db->prepare('update equipement set nom=?, quantite=?, disponibilite=? where ide=?');
    $req->bindValue(1, $_POST['nom']);
    $req->bindValue(2, $_POST['quantite']);
    $req->bindValue(3, $_POST['disponibilite']);
    $req->bindValue(4, $_POST['ide']);
    $req->execute();
    header('Location: listeEquipement.php');
}


include 'header.php';
?>

<div class="col-xl container">
    <div class="card mt-4 mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ajouter Equipement</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="ajouterEquipement.php">
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Nom Equipement" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" name="nom" value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>" />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="html5-number-input" class="form-label">Quantite</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="number" id="html5-number-input" aria-label="john.doe" aria-describedby="basic-icon-default-email2" name="quantite" required value="<?php if (isset($_POST['quantite'])) echo $_POST['quantite']; ?>" />
                    </div>
                </div>

                <div class="mt-2 mb-3">
                    <label for="largeSelect" class="form-label">Disponibilite</label>
                    <select id="largeSelect" class="form-select form-select-lg" name="disponibilite">
                        <option><?php if (isset($_POST['disponibilite'])) echo $_POST['disponibilite']; ?> </option>
                        <option value="Disponible">Disponible</option>
                        <option value="Non Disponible">Non Disponible</option>
                    </select>
                </div>

                <?php if (isset($_GET['idm'])) : ?>
                    <input type="hidden" name="ide" value="<?php if (isset($_POST['ide'])) echo $_POST['ide']; ?>">
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