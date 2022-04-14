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
    '<h1>Liste des produits</h1>',
    '<br>';

    foreach ($_SESSION['produits'] as $index => $produit) {  // On boucle les produits inscrient dans la session dans un tableau html
        echo
        '<div class ="liste">',
        '<div class="card">',
        '<h3 class="card-header">' . $produit['nom'] . '</h3>',
        '<img src ="./upload/' . $produit['file'] . '">',
        '</svg>',
        '<div class="card-body">',
        '<p class="card-text">' . $produit['description'] . '</p>',
        '</div>',
        '<div class="card-footer">',
        'Prix : ' . number_format($produit['prix'], 2, ',', '&nbsp;') . '&nbsp;€</td>',
        '</div>',
        '</div>';
    }
    echo
    '</div>';
}
