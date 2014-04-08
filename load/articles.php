<?php
header('Content-Type: application/json');

$pdo = new PDO("mysql:host=localhost;dbname=load_more;charset=utf8", "root", "");

$articles = [];

$start = isset($_GET['start']) ? (int)$_GET['start'] - 1 : 0;
$count = isset($_GET['count']) ? (int)$_GET['count'] : 1;

$article = $pdo->query("SELECT SQL_CALC_FOUND_ROWS * FROM articles LIMIT {$start}, {$count}");
$articles_total = $pdo->query("SELECT FOUND_ROWS() AS count")->fetch(PDO::FETCH_ASSOC)['count'];

if($articlesCount = $article->rowCount()) {
	$articles = $article->fetchAll(PDO::FETCH_OBJ);
}

// print_r($articles); die;

echo json_encode(array(
	'items' => $articles,
	'last' => ($start + $count) >= $articles_total ? true : false,
	'start' => $start,
	'count' => $count
));