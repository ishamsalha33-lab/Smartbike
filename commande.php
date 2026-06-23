<?php
// commande.php
include 'config.php';

if (empty($_SESSION['panier'])) {
    header('Location: index.php');
    exit;
}

$message_succes = "";

if (isset($_POST['valider_commande'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $adresse = htmlspecialchars($_POST['adresse']);
    
    $total_general = 0;
    $ids = array_keys($_SESSION['panier']);
    $imploded_ids = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT prix, id FROM produits WHERE id IN ($imploded_ids)");
    $stmt->execute($ids);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($produits as $produit) {
        $quantite = $_SESSION['panier'][$produit['id']];
        $total_general += $produit['prix'] * $quantite;
    }

    $sql = "INSERT INTO commandes (nom_client, email, adresse, total) VALUES (?, ?, ?, ?)";
    $insert = $pdo->prepare($sql);
    $insert->execute([$nom, $email, $adresse, $total_general]);
    
    unset($_SESSION['panier']);
    $message_succes = "Merci $nom ! Votre commande de " . number_format($total_general, 2, ',', ' ') . " € a été enregistrée.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Finaliser la commande - SmartBike</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><a href="index.php">SmartBike</a></h1>
</header>

<div class="container container-commande">
    <h2>Finaliser mon achat</h2>

    <?php if (!empty($message_succes)): ?>
        <div class="succes"><?php echo $message_succes; ?></div>
        <p style="text-align:center;"><a href="index.php" class="retour">← Retourner à la boutique</a></p>
    <?php else: ?>
        <form method="post" action="commande.php">
            <div class="champ">
                <label for="nom">Nom complet :</label>
                <input type="text" id="nom" name="nom" required placeholder="Ex: Jean Dupont">
            </div>
            
            <div class="champ">
                <label for="email">Adresse Email :</label>
                <input type="email" id="email" name="email" required placeholder="Ex: jean@example.com">
            </div>
            
            <div class="champ">
                <label for="adresse">Adresse de livraison :</label>
                <textarea id="adresse" name="adresse" rows="4" required placeholder="Ex: 12 rue de la Paix, 75001 Paris"></textarea>
            </div>
            
            <button type="submit" name="valider_commande" class="btn-payer">Confirmer et payer</button>
        </form>
        <p style="text-align:center;"><a href="panier.php" class="retour">← Revenir au panier</a></p>
    <?php endif; ?>
</div>

</body>
</html>