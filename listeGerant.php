<?php
require 'connexion.php';
$_POST['title'] = 'Entraineur';

$sql = 'select count(*) from gerant';
$req = $db->query($sql);
$compte = $req->fetchColumn();
if ($compte > 1) {
    if (isset($_GET['ids'])) {
        $db->query('delete from gerant where id=' . $_GET['ids']);
        header('Location: listeGerant.php');
    }
}

include 'header.php';
?>
<h1 class="text-center text-light m-0">Liste des Gérants</h1>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Login</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $req = $db->query("SELECT * FROM gerant");
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo "<tr>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>' . $ligne['prenom'] . '</td>';
            echo '<td>' . $ligne['login'] . '</td>';
            echo '<td> 
            <a href="ajouterGerant.php?idm=' . $ligne['id'] . '"><i class="bx bx-edit-alt" style="color:#f3af02" ></i> </a>
            <a href="listeGerant.php?ids=' . $ligne['id'] . '"  class="ms-2"><i class="bx bx-trash" style="color:#f30202"></i> </a>
            </td>';
            $i++;
            echo "</tr>";
        }


        ?>
    </tbody>

</table>

<?php include 'footer.php'; ?>