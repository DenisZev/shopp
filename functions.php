<?php
require_once "db.php";

function getProduct($idproduct ){
	global $connection;

	$query = "SELECT * FROM `product` WHERE " .$idproduct;
	$req = mysqli_query($connection, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}
function getCategory($id) {
    $query = "SELECT * FROM category";
}
function getImage($idproduct) {
    global $connection;
    $query = "SELECT title, main_image, image from product JOIN image on product.main_image = image.idimage";
    $req = mysqli_query($connection, $query);
    $resp = mysqli_fetch_assoc($req);
    return $resp;
}