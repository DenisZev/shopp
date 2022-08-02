<?php 
session_start();

if (isset($_SESSION['cart_list'])) {
	echo "Корзина: " . count($_SESSION['cart_list']) ;
}

require_once "db.php";

if ( isset($_GET['id']) ) {
	$query = "SELECT * FROM product WHERE idproduct=" . $_GET['id'];

	$req = mysqli_query($connection, $query);
	$product = mysqli_fetch_assoc($req);


	if (empty($product)) {
		header("Location: 404.php");
	}
}

?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<a href="index.php">Главная</a>

	<h1>
		<?php echo $product['title']?>
	</h1>

	<p>
		<?php echo $product['decsription']?>
	</p>

	<p><strong>
		<?php echo $product['price']?> Рублей
	</strong></p>

	<a href="order.php?title=<?php echo $product['title']?>">Купить в 1 клик</a>
	<br>
	<a href="cart.php?product_id=<?php echo $product['idproduct']?>">Добавить в корзину</a>

	
</body>
</html>