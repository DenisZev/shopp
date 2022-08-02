<?php
session_start();

if (isset($_SESSION['cart_list'])) {
	echo "Корзина: " . count($_SESSION['cart_list']) ;
}

require_once "db.php";


$query = "SELECT * FROM `product` JOIN image on product.main_image = image.idimage WHERE activity = 1 ";
$queryImage = "SELECT title, main_image, image from product JOIN image on product.main_image = image.idimage";
$req = mysqli_query($connection, $query);
$data_from_db = [];

while ($result = mysqli_fetch_assoc($req)) {
	$data_from_db[] = $result;
}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Lamoda</title>
</head>

<style>
	body {
		font-family: Tahoma, serif;
	}

	h1 {
		text-align: center;
	}

	#center {
		width: 900px;
		margin: 0 auto;
		overflow: hidden;
	}

	.course_item {
		width: 260px;
		float: left;
		background: #424242;
		color: #fff;
		margin: 0 10px;
		padding: 10px ;
	}

	.course_item a {
		display: block;
		color: #424242;
		text-decoration: none;
		text-align: center;
		border: 1px solid #fff;
		padding: 10px 0;
		margin: 0 0 10px 0;
		background: #fff;
	}

	.course_item a:hover {
		background: transparent;
		color: #fff;
	}
</style>

<body>

	<h1>Lamoda</h1>

	<div id="center">

		<?php foreach($data_from_db as $item): ?>

		<div class="course_item">
			<h2>
				<?php echo $item['title']?>
			</h2>
            <img src="<?php echo $item['image']?>" alt="<?php echo $item['alt']?>" style="width: 100%; height: 100%">
			<p>
				<?php echo $item['decsription']?>
			</p>

			<p><s>
				<?php echo $item['price']?>
			</s><strong style="margin-left: 25px"><?php echo $item['promo_price'] ?></strong></p>

			<a href="single.php?id=<?php echo $item['idproduct']?>">
				Подробнее
			</a>

			<a href="cart.php?item_id=<?php echo $item['idproduct']?>">
				В корзину
			</a>
		</div>
		
		<?php endforeach;?>

	</div>

</body>
</html>