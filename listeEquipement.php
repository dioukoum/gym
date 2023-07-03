<?php
require 'connexion.php';


if (isset($_GET['ids'])) {
    $db->query('delete from equipement where ide=' . $_GET['ids']);
    header('Location: listeEquipement.php');
}


include 'header.php';
?>
<h1 class="text-center text-light m-0">Liste des Equipements</h1>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Disponibilité</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $req = $db->query("SELECT * FROM equipement");
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo "<tr>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>' . $ligne['quantite'] . '</td>';
            echo '<td>' . $ligne['disponibilite'] . '</td>';
            echo '<td> 
            <a href="ajouterEquipement.php?idm=' . $ligne['ide'] . '"><i class="bx bx-edit-alt" style="color:#f3af02" ></i> </a>
            <a href="listeEquipement.php?ids=' . $ligne['ide'] . '"  class="ms-2"><i class="bx bx-trash" style="color:#f30202"></i> </a>
            </td>';
            $i++;
            echo "</tr>";
        }


        ?>
    </tbody>

</table>

<?php include 'footer.php'; ?>