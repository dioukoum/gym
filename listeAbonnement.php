<?php
require 'connexion.php';


if (isset($_GET['ids'])) {
    $db->query('delete from abonnement where numeroAbonne=' . $_GET['ids']);
    header('Location: listeAbonnement.php');
}


include 'header.php';
?>
<h1 class="text-center text-light m-0">Liste des Abonnements</h1>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Montant</th>
            <th>Date debut</th>
            <th>Date fin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $req = $db->query("SELECT * FROM abonnement");
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo "<tr>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['montant'] . '</td>';
            echo '<td>' . $ligne['dateDebut'] . '</td>';
            echo '<td>' . $ligne['dateFin'] . '</td>';
            echo '<td> 
            <a href="ajouterAbonnement.php?idm=' . $ligne['numeroAbonne'] . '"><i class="bx bx-edit-alt" style="color:#f3af02" ></i> </a>
            <a href="listeAbonnement.php?ids=' . $ligne['numeroAbonne'] . '"  class="ms-2"><i class="bx bx-trash" style="color:#f30202"></i> </a>
            </td>';
            $i++;
            echo "</tr>";
        }


        ?>
    </tbody>

</table>

<?php include 'footer.php'; ?>