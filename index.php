<?php
// index.php
include 'config.php';

if (isset($_POST['ajouter_panier'])) {
    $id_produit = intval($_POST['id_produit']);
    if (!isset($_SESSION['panier'])) { $_SESSION['panier'] = []; }
    
    if (isset($_SESSION['panier'][$id_produit])) {
        $_SESSION['panier'][$id_produit]++;
    } else {
        $_SESSION['panier'][$id_produit] = 1;
    }
    header('Location: index.php');
    exit;
}

$categorie_choisie = isset($_GET['categorie']) ? $_GET['categorie'] : '';
if (!empty($categorie_choisie)) {
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE categorie = ?");
    $stmt->execute([$categorie_choisie]);
} else {
    $stmt = $pdo->query("SELECT * FROM produits");
}
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nb_articles_panier = isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SmartBike - Boutique Moderne</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><a href="index.php">SmartBike</a></h1>
    <a href="panier.php" class="Lien-panier">🛒 Mon Panier <span><?php echo $nb_articles_panier; ?></span></a>
</header>

<div class="container">
    <h2>Découvrez nos Smartbikes</h2>
    
    <div class="filtres">
        <a href="index.php" class="<?php echo empty($categorie_choisie) ? 'active' : ''; ?>">Tous les vélos</a>
        <a href="index.php?categorie=Urbain" class="<?php echo $categorie_choisie == 'Urbain' ? 'active' : ''; ?>">Urbain</a>
        <a href="index.php?categorie=VTT" class="<?php echo $categorie_choisie == 'VTT' ? 'active' : ''; ?>">VTT</a>
        <a href="index.php?categorie=Sport" class="<?php echo $categorie_choisie == 'Sport' ? 'active' : ''; ?>">Sport</a>
    </div>

    <div class="grille-produits">
        <?php foreach ($produits as $produit): ?>
            <div class="carte-produit">
                <div class="image-container">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($produit['image']); ?>" alt="<?php echo $produit['nom']; ?>">
                </div>
                <span class="badge-cat"><?php echo $produit['categorie']; ?></span>
                <h3><?php echo $produit['nom']; ?></h3>
                <p><?php echo $produit['description']; ?></p>
                <div class="prix"><?php echo number_format($produit['prix'], 2, ',', ' '); ?> €</div>
                
                <form method="post" action="index.php">
                    <input type="hidden" name="id_produit" value="<?php echo $produit['id']; ?>">
                    <button type="submit" name="ajouter_panier" class="btn">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>