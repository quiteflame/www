<!DOCTYPE html>
<html>
	<HEAD>
		<meta charset="UTF-8">
	</HEAD>
</html>

<?php

$cake = "Sweet unerdwear.com halvah candy canes ice cream bear claw pie cookie cupcake. Applicake pie soufflé apple pie danish marshmallow. Gingerbread unerdwear.com toffee biscuit cookie bear claw chupa chups powder sesame snaps. Marzipan gummies icing marshmallow soufflé. Pudding tart chocolate bar fruitcake sesame snaps macaroon. Marzipan powder chocolate cake macaroon dragée croissant pastry cake cookie. Jelly carrot cake chocolate bar biscuit danish. Gummi bears halvah ice cream wafer oat cake donut pie. Muffin wafer croissant carrot cake cupcake brownie gummi bears chupa chups caramels. Wafer marshmallow cake. Cupcake marzipan pie tart. Dragée powder jelly.
Croissant halvah sweet roll. Croissant marzipan sweet. Wafer pie apple pie lollipop chupa chups tart wafer topping jelly. Gummi bears oat cake bonbon pudding tootsie roll. Oat cake cupcake macaroon pastry candy canes soufflé biscuit chocolate cake jelly-o. Chocolate lollipop chocolate cake muffin marzipan fruitcake wafer. Bonbon lollipop chupa chups sweet roll tootsie roll. Pie gingerbread cheesecake pudding jelly gingerbread. Candy muffin marshmallow chocolate bar cupcake cookie oat cake chocolate bar halvah. Candy canes dessert croissant wafer chocolate cake chocolate bar. Candy canes cookie icing marzipan. Halvah jelly jujubes jelly oat cake tart. Cotton candy tart pie gingerbread bear claw jelly pudding. Sugar plum sesame snaps sweet roll.
Sweet roll lollipop bonbon gummi bears macaroon gingerbread toffee. Unerdwear.com gummies bear claw danish applicake ice cream biscuit halvah soufflé. Halvah jelly-o liquorice chupa chups cookie macaroon topping jelly macaroon. Tart gummi bears cookie brownie lemon drops. Croissant jelly-o tootsie roll lemon drops tart apple pie. Sweet topping carrot cake candy canes macaroon. Jelly beans gingerbread chocolate bar cheesecake. Dessert jelly-o gingerbread oat cake powder cookie. Icing sugar plum macaroon toffee oat cake. Powder donut macaroon marzipan bear claw chocolate bar powder cupcake soufflé. Halvah marzipan cupcake pastry. Brownie donut sesame snaps bonbon powder candy canes fruitcake.
Chupa chups gummi bears chocolate cake danish carrot cake topping marzipan. Jelly-o macaroon apple pie candy cupcake. Tart donut brownie topping sweet roll sweet roll soufflé bonbon lemon drops. Sugar plum topping candy canes donut halvah chupa chups carrot cake. Tootsie roll jujubes macaroon jelly-o. Tart toffee gummi bears. Biscuit liquorice tart cake croissant tart candy canes. Muffin carrot cake cheesecake tootsie roll macaroon jelly caramels chocolate bar. Cotton candy gingerbread caramels cheesecake. Bonbon gummi bears apple pie pastry cotton candy cotton candy. Donut dragée caramels brownie brownie sweet roll apple pie donut lemon drops. Marzipan toffee macaroon danish lemon drops chocolate pudding dragée macaroon. Chocolate cake sweet roll topping croissant.";

$cake_mass = strlen($cake);

for ($i=0; $i < 150; $i++) { 
	$random_knife = rand($cake_mass / 2, $cake_mass);
	$cake_slice = substr($cake, 0, $random_knife);
	echo "INSERT INTO  `load_more`.`articles` (`title` , `description`) VALUES ('Article ".($i + 1)."',  '".$cake_slice."');<br>";
}
