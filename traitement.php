<?php

session_start();
require_once 'functions.php';

if (isset($_GET['action'])) {
    // On verifie si une action existe alors on fais cas 1,2,3 etc selon l'action

    switch ($_GET['action']) {
        case 'ajouter':

            if (isset($_POST['submit'])) {
                // Si l'action de posté un formulaire avec submit est effectuée on vérifie les champs par des filtres de nettoyage

                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING); // Attention filtre obsolete voir doc
                $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantite = filter_input(INPUT_POST, 'quantite', FILTER_VALIDATE_INT);
                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

                if (isset($_FILES['file'])) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];
                    $type = $_FILES['file']['type'];

                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));

                    $validExtension = ['jpg', 'jpeg'];
                    $tailleMax = 400000;

                    if (in_array($extension, $validExtension) && $size < $tailleMax && $error == 0) {
                        $uniqueName = uniqid('', true);
                        $fileName = $uniqueName . '.' . $extension;
                        move_uploaded_file($tmpName, './upload/' . $fileName);
                    } else {
                        echo 'Erreur, mauvaise extension ou taille trop important';
                    }


                    if ($nom && $prix && $quantite && $description) {
                        // Si les datas sont correct aprés les filtres on les rentre dans le tableau $produit -> $_SESSION['produits']

                        $produit = [
                            'nom' => $nom,
                            'prix' => $prix,
                            'quantite' => $quantite,
                            'description' => $description,
                            'file' => $fileName,
                            'total' => $prix * $quantite,
                        ];

                        $_SESSION['produits'][] = $produit;
                        setMessage('success', 'Votre produit à bien été ajouté'); // On set le message pour dire succés le msg est envoyé
                    }
                }
            }

            header('Location:index.php'); // On redirige vers index.php

            die();
            break;

        case 'supprimer':

            $prod = $_SESSION['produits'][$_GET['id']];
            unlink("upload/" . $prod['file']);
            unset($_SESSION['produits'][$_GET['id']]);      // On Détruit la qte de produit grace à la fonction array_splice()
            // array_splice() = Efface et remplace une portion de tableau
            header('Location:recap.php');
            die();
            break;

        case 'vider':

            if (file_exists("upload/" . $_SESSION["produits"][$index]["file"])) {
                $prod1 = glob("upload/*");
                foreach ($prod1 as $pro) {
                    if (is_file($pro)) {
                        unlink($pro);
                    }
                }
            }

            unset($_SESSION['produits']);      // On Détruit toutes les variables de la session.
            header('Location:recap.php');
            die();
            break;

        case 'plus':

            if ($_SESSION['produits'][$_GET['id']]['quantite'] > 0) {
                if (isset($_GET['id']) && $_SESSION['produits'][$_GET['id']]) {
                    // Si le nom du prduit existe et dans la session aussi on incrémente celui ci dans le tableau

                    ++$_SESSION['produits'][$_GET['id']]['quantite']; // incrémente

                    $_SESSION['produits'][$_GET['id']]['total'] =
                        $_SESSION['produits'][$_GET['id']]['prix'] * $_SESSION['produits'][$_GET['id']]['quantite'];
                    header('Location: recap.php');
                } else {
                    echo 'Le produit ne peux pas être négatif';
                }
            }
            die(); // Alias de la fonction exit
            break; // Casse l'execution de la boucle

        case 'moins':

            if ($_SESSION['produits'][$_GET['id']]['quantite'] > 0) {
                if (isset($_GET['id']) && $_SESSION['produits'][$_GET['id']]) {
                    // Si l'id du prduit existe et dans la session aussi on décrémente celui ci dans le tableau

                    --$_SESSION['produits'][$_GET['id']]['quantite'];
                    $_SESSION['produits'][$_GET['id']]['total'] =
                        $_SESSION['produits'][$_GET['id']]['prix'] * $_SESSION['produits'][$_GET['id']]['quantite'];
                    header('Location: recap.php');
                } else {
                    echo 'Le produit ne peux pas être négatif';
                }
            }
            break;
    }
}
