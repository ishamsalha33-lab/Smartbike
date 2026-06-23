<?php
// panier.php
include 'config.php';

if (isset($_GET['action']) && $_GET['action'] == 'vider') {
    unset($_SESSION['panier']);
    header('Location: panier.php');
    exit;
}

$produits_panier = [];
$total_general = 0;

if (!empty($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    $imploded_ids = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id IN ($imploded_ids)");
    $stmt->execute($ids);
    $produits_panier = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier - SmartBike</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><a href="index.php">SmartBike</a></h1>
    <a href="index.php">← Retour au catalogue</a>
</header>

<div class="container">
    <h2>Votre Panier</h2>

    <?php if (empty($produits_panier)): ?>
        <p>Votre panier est vide pour le moment.S</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Vélo</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits_panier as $produit): 
                    $quantite = $_SESSION['panier'][$produit['id']];
                    $sous_total = $produit['prix'] * $quantite;
                    $total_general += $sous_total;
                ?>
                <tr>
                    <td><strong><?php echo $produit['nom']; ?></strong></td>
                    <td><?php echo number_format($produit['prix'], 2, ',', ' '); ?> €</td>
                    <td><?php echo $quantite; ?></td>
                    <td><?php echo number_format($sous_total, 2, ',', ' '); ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">Total Général : <?php echo number_format($total_general, 2, ',', ' '); ?> €</div>

        <div class="actions">
            <a href="panier.php?action=vider" class="btn-action btn-vider">Vider le panier</a>
            <a href="commande.php" class="btn-action btn-commander">Passer la commande →</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>