<?php
require_once "header.php";
session_start();
// restaure les données trouvée sur le serveur dans index
?>
<?php


if (!isset($_SESSION['produits']) || empty($_SESSION['produits'])) {  // Si la session avec les infos produits existe pas OU qu'elle est vide on génère les produits
    echo '<p><b>Aucun produit en session ...</b></p>';
} else {
    echo
    '<div class="jumbotron jumbotron-fluid">',
    '<div class="container">',
    '<h1>Récapitulatif des produits</h1>',
    '<br>',
    '<table>',
    '<thead>',
    '<tr>',
    '<th>#</th>',
    '<th><b>Nom</b></th>',
    '<th><b>Prix<b></th>',
    '<th><b>Quantité<b></th>',
    '<th><b>Total<b></th>',
    '<th>&nbsp;</th>',
    '</tr>',
    '</thead>',
    '<tbody>',
    '</div>',
    '</div>';
    $totalGeneral = 0;
    $TotalQtt = 0;
    foreach ($_SESSION['produits'] as $index => $produit) {  // On boucle les produits inscrient dans la session dans un tableau html
        echo   '<tr>',
        '<td>' . $index . '</td>', // Index correspondra au produit en question touts les $produit['X'] seront les attribut du produit
        '<td>' . $produit['nom'] . '</td>',
        '<td>' . number_format($produit['prix'], 2, ',', '&nbsp;') . '&nbsp;€</td>',
        '<td><a href="traitement.php?action=moins&id=' . $index . '"><i class="fa-solid fa-minus"></i></a>' . $produit['quantite'] . '<a href="traitement.php?action=plus&id=' . $index . '"><i class="fa-solid fa-plus"></i></a></td>',
        '<td>' . number_format($produit['total'], 2, ',', '&nbsp;') . '&nbsp;€</td>',
        '<td><a href="traitement.php?action=supprimer&id=' . $index . '"> <i class="fa-solid fa-trash"></i></a></td>',
        '</tr>';
        $totalGeneral += $produit['total'];
        $TotalQtt += $produit['quantite'];
    }
    echo '<tr>',
    '<td colspan=4> Total général : </td>',
    '<td id="tt"><strong><div class="TG">' . number_format($totalGeneral, 2, ',', '&nbsp;') . '&nbsp;€</strong></div></td>', // Transforme le nombre en (chiffer,2chiffre,espace)
    '</tr>',
    '<tr>',
    '<td colspan=4> Panier : </td>',
    '<td id="tt"><strong><div class="TG">' . number_format($TotalQtt, 0, ',', '&nbsp;') . '&nbsp;</strong></div></td>', // Transforme le nombre en (chiffer,2chiffre,espace)
    '</tr>',
    '</tbody>',
    '</table>';
}
?>
<br>
<a href="traitement.php?action=vider"><button type="button" class="btn btn-danger">Vider le panier</button></a>
<!-- On met un lien la page de traitement s'occupera du script qui aura l'action de vider le panier -->

</div>
</div>
</body>

</html>