<?php
session_start();


require_once "db.php";
require_once "functions.php";


if ( isset($_GET['delete_id']) && isset($_SESSION['cart_list']) ) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ( $value['id'] == $_GET['delete_id'] ) {
			unset($_SESSION['cart_list'][$key]);
		}		
	}
}


if ( isset($_GET['idproduct']) && !empty($_GET['idproduct']) ) {

	$current_added_item = getProduct($_GET['idproduct']);

	// ...
	if ( !empty($current_added_item) ) {

		if ( !isset($_SESSION['cart_list'])) {
			$_SESSION['cart_list'][] = $current_added_item;
		}


		$course_check = false;

		if ( isset($_SESSION['cart_list']) ) {
			foreach ($_SESSION['cart_list'] as $value) {
				if ( $value['id'] == $current_added_item['id'] ) {
					$course_check = true;
				}
			}
		}


		if ( !$course_check ) {
			$_SESSION['cart_list'][] = $current_added_item;
		}

	} else {
		header("Location: 404.php");
	}
	
}

// var_dump($_SESSION);




?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<a href="index.php">На главную</a>

	<h1>Корзина</h1>

	<?php if ( isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) !=0 ) : ?>
	
		<ul>
			<?php foreach($_SESSION['cart_list'] as $item ) : ?>

				<li>
					<?php echo $item['title']; ?> |
					<?php echo $item['price']; ?> руб. |
					<a href="cart.php?delete_id=<?php echo $item['id'];?>">Х</a>
				</li>

			<?php endforeach; ?>
		</ul>
	
	<?php else : ?>

		<p>
			Ваша корзина пуста
		</p>

	<?php endif; ?>


	<a href="index.php">Продолжить покупки</a>
	<br>
	<a href="order.php">Оформить заказ</a>
	
</body>
</html>