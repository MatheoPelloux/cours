<?php

# Commence la session pour sauvegarder les matrices afin de vérifier si elle sont juste ou fausses.
session_start();

# Fonction qui calcule le résultat de la matrice 2x2 et retourne une variable qui contient le résultat.
function mactrice2x2($matriceA, $matriceB) {
    $resultat = [
        $matriceA[0][0] + $matriceB[0][0], $matriceA[0][1] + $matriceB[0][1],
        $matriceA[1][0] + $matriceB[1][0], $matriceA[1][1] + $matriceB[1][1]
    ];
    return $resultat;
}

# Fonction qui vérifie si l'utilisateur a juste ou non grâce à sa réponce et à la variable "resultat".
function verifiaction2x2 ($resultat) {
    if (!isset($_POST['input1'], $_POST['input2'], $_POST['input3'], $_POST['input4'])) {
        return ""; 
    }

    # On recrée un tableau pour que les valeurs de l'utilisateur soient en valeur numerique (int) et non valeur texte (str).
    $input1 = (int)$_POST['input1'];
    $input2 = (int)$_POST['input2'];
    $input3 = (int)$_POST['input3'];
    $input4 = (int)$_POST['input4'];

    $reponceUtilisateur = [$input1, $input2, $input3, $input4];

    if ($reponceUtilisateur == $resultat) {
        return "<p style='color: green; font-weight:bold;'>✅ Bonne réponce !</p>";
    } else {
        return "<p style='color: red; font-weight:bold;'>❌ Mauvaise réponce !</p>";
    }
}

# Permet de faire un nouvel exercice en oubliant les matrices précédentes et le message qui indique si c'est une bonne réponce ou non.
if (isset($_POST['nouvel_exo'])) {

    unset($_SESSION['matriceA']);
    unset($_SESSION['matriceB']);

    $message = ""; 
}

# Initialisation des variables minimum et maximum des nombre aléatoire.
$min = 1;
$max = 20;

# Vérifie si dans la variable $_SESSION "matriceA" et "matriceB" n'existent pas, si elles n'existent pas, les crée sinon ne rien faire.
if (!isset($_SESSION['matriceA']) || !isset($_SESSION['matriceB'])) {
    $nb1 = random_int($min, $max);
    $nb2 = random_int($min, $max);
    $nb3 = random_int($min, $max);
    $nb4 = random_int($min, $max);

    $nb5 = random_int($min, $max);
    $nb6 = random_int($min, $max);
    $nb7 = random_int($min, $max);
    $nb8 = random_int($min, $max);

    $_SESSION['matriceA'] = [
            [$nb1, $nb2],
            [$nb3, $nb4]
        ];

    $_SESSION['matriceB'] = [
            [$nb5, $nb6],
            [$nb7, $nb8]
        ];
}

# Récupération des matrices dans une variable dédiée, enfin de les afficher visuellement sur la page web.
$matriceA = $_SESSION['matriceA'];
$matriceB = $_SESSION['matriceB'];

# Appel des fonctions et récupération des valeurs dans des variables.
$resultat2x2 = mactrice2x2($matriceA, $matriceB);
$message2x2 = verifiaction2x2($resultat2x2);

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrice addition</title>
</head>
<body>
    <nav>
        <a href="/index.php">Acueil</a>
        <h1>Matrice addition</h1>
        <iframe width="640" height="360" src="https://www.youtube.com/embed/MMBfOom_mac?si=MZbL4hZf9ei5l31r" frameborder="0" allowfullscreen></iframe>
    </nav>
    <section>
        <h2>Cours</h2>
        <p>Pour additionner deux matrices il faut déjà s'assurer qu'elles ont la <strong>même taille</strong> (par exemple 2×2 ou 3×3), <br>
        on additionne les éléments qui <strong>occupent la même position</strong> dans chaque matrice.</p>
        <p>Exemple :</p>
        <img with="640" height="360" src="../../../src/img/img_math/matrice/matrice_addition_ph1.jpeg" alt="image 1, matrice addition">
    </section>
    <section>
        <div>
            <h2>Exercice 1 (2x2)</h2>
            <p><?= "A= ({$matriceA[0][0]} {$matriceA[0][1]}) + B= ({$matriceB[0][0]} {$matriceB[0][1]})" ?></p>
            <p><?= "A= ({$matriceA[1][0]} {$matriceA[1][1]}) + B= ({$matriceB[1][0]} {$matriceB[1][1]})" ?></p>
        </div>
        <div>
            <form id="reponce2x2" method="post" enctype="multipart/form-data" action="addition.php">
                <input type="text" name="input1">
                <input type="text" name="input2"> <br>
                <input type="text" name="input3">
                <input type="text" name="input4">
                <input type="submit" value="Validé">
            </form>
            <form method="post" action="addition.php">
                <input type="hidden" name="nouvel_exo" value="true">
                <input type="submit" value="Nouvel Exercice">
            </form>
            <div>
                <?= $message2x2 ?>
            </div>
    </section>
</body>
</html>