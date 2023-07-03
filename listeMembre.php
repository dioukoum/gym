<?php
require 'connexion.php';


if (isset($_GET['ids'])) {
    $db->query('delete from membre where id=' . $_GET['ids']);
    header('Location: listeMembre.php');
}


include 'header.php';
?>
<h1 class="text-center text-light m-0">Liste des Membres</h1>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>telephone</th>
            <th>Login</th>
            <th>Abonnement</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $req = $db->query("SELECT * FROM membre left join abonnement on membre.numeroAbonne=abonnement.numeroAbonne");
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo "<tr>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>' . $ligne['prenom'] . '</td>';
            echo '<td>' . $ligne['telephone'] . '</td>';
            echo '<td>' . $ligne['login'] . '</td>';
            echo '<td>' . $ligne['dateDebut'] . ' au ' . $ligne['dateFin'] . '</td>';
            echo '<td> 
            <a href="ajouterMembre.php?idm=' . $ligne['id'] . '"><i class="bx bx-edit-alt" style="color:#f3af02" ></i> </a>
            <a href="listeMembre.php?ids=' . $ligne['id'] . '"  class="ms-2"><i class="bx bx-trash" style="color:#f30202"></i> </a>
            </td>';
            $i++;
            echo "</tr>";
        }


        ?>
    </tbody>

</table>

<?php include 'footer.php'; ?>