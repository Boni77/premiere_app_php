<?php require_once "header.php";
require_once 'functions.php';
?>

<body>


    <div class="jumbotron jumbotron-fluid">
        <div class="container">

            <h1>Ajouter un Produit</h1>

            <form action="traitement.php?action=ajouter" method="post" enctype="multipart/form-data">
                <!-- Le formulaire à la méthode post et son action sera d'ajouter un produit -->

                <p>
                    <label>
                        <br>Nom du produit :<br>
                        <input type="text" name="nom">
                    </label>
                </p>

                <p>
                    <label>
                        <br>Prix du produit :<br>
                        <input type="text" step="any" name="prix" min="0">
                    </label>
                </p>

                <p>
                    <label>
                        <br>Quantité produit :<br>
                        <input type="number" name="quantite" min="0">
                    </label>
                </p>
                <p>
                    <label>
                        <textarea name="description" placeholder="Entrez une description du produit"></textarea>

                    </label>
                </p>
                <p>
                    <label for="fileName">Image</label>
                    <input type="file" name="file"><br>
                </p>
                <p>
                    <button type="submit" name="submit" value="submit" class="btn btn-success">Ajouter produit</button>

            </form>
        </div>
        <br>
        <br>
        <div class="alert alert-dismissible alert-primary">
            <a href="recap.php" class="alert-link">Consulter le récapitulatif des commandes içi.</a>
        </div>

    </div>

</body>

</html>