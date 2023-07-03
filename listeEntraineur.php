<?php
require 'connexion.php';


if (isset($_GET['ids'])) {
    $db->query('delete from entraineur where idEnt=' . $_GET['ids']);
    header('Location: listeEntraineur.php');
}


include 'header.php';
?>
<h1 class="text-center text-light m-0">Liste des Entraineurs</h1>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Spécialité</th>
            <th>Login</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $req = $db->query("SELECT * FROM entraineur");
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo "<tr>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>' . $ligne['prenom'] . '</td>';
            echo '<td>' . $ligne['specialite'] . '</td>';
            echo '<td>' . $ligne['login'] . '</td>';
            echo '<td> 
            <a href="ajouterEntraineur.php?idm=' . $ligne['idEnt'] . '"><i class="bx bx-edit-alt" style="color:#f3af02" ></i> </a>
            <a href="listeEntraineur.php?ids=' . $ligne['idEnt'] . '"  class="ms-2"><i class="bx bx-trash" style="color:#f30202"></i> </a>
            </td>';
            $i++;
            echo "</tr>";
        }


        ?>
    </tbody>

</table>

<?php include 'footer.php'; ?>