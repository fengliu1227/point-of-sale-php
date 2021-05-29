<!DOCTYPE html>
<html>
<head>
  <title>Point of sale - API</title>
  <script src="jquery-2.1.4.js"></script>
  <style>
p{
    color:#f509c2;
}
#main {
    opacity: 0.8;
    background-color: #a9e7ff;
    box-sizing: border-box;
    display: block;
    text-align: center;
    width: 55%;
    box-shadow: 0 4px 8px 0 rgba(218, 243, 149, 0.2);
    border-radius: 15px;
    padding: 1%;
    margin: auto;
    margin-top: 5%
}
#edit {
    opacity: 0.8;
    background-color: #e1e1e1;
    box-sizing: border-box;
    display: block;
    text-align: center;
    width: 98%;
    box-shadow: 0 4px 8px 0 rgba(218, 243, 149, 0.2);
    border-radius: 15px;
    padding: 1%;
    margin: auto;
    margin-top: 5%
}
input[type="text"], textarea {

  background-color : #d1d1d1; 

}
  </style>
</head>
<body>
<div>
<div id = main>
<h1>Input the product code and get the result</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  <input type="text" name="product_input"/>
  <button type="submit" name="check-out">Check Out</button>
</form>
</div>
<div id = edit>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  product code:<input type="text" name="price_code"/>
  set up price: <input type="text" name="price_input"/>
  <button type="submit" name="set_price">set pricing</button>
</form>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  product code:<input type="text" name="vol_size_input_code"/>
  volume size:   <input type="text" name="vol_size_input"/>
  <button type="submit" name="set_vol_size">set volume size</button>
</form>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  product code:<input type="text" name="vol_price_code"/>
  volume price:<input type="text" name="vol_price_input"/>
  <button type="submit" name="set_vol_price">set volume price</button>
</form>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  product code:<input type="text" name="stock_code"/>
  set up stock: <input type="text" name="stock_input"/>
  <button type="submit" name="set_stock">set stock</button>
</form>

</div>
</div>
<div>
	<?php 
		include 'TerminalClass.php';
		session_start();
		if(isset($_SESSION['terminal_string'])){

		$terminal = unserialize($_SESSION['terminal_string']);

		}else{
			$product_inventory = new Inventory();
			$product_inventory->add(2.0, 99, "A", true, 7, 4, false, null);
			$product_inventory->add(10.0, 99, "B", false, 0, 0, false, null);
			$product_inventory->add(1.25, 99, "C", true, 6.0, 6, false, null);
			$product_inventory->add(0.15, 99, "D", true, 7, 4, false, null);
			$product_inventory->add(2.0, 99, "E", false, 0, 0, true, "B");


			$terminal = new Terminal($product_inventory);
		}

		$products = $terminal->getInventory();
		echo "Product Code | Price  (IF THE PRICE DOESN'T UPDATE, PLEASE REFRESH THE PAGE) </br>";
		echo "--------------------</br>";
		echo "A           | $" . $products->get('A')->getPrice() . " each";
		if($products->get('A')->isVolumeSale()){
			echo " or ". $products->get('A')->getVolumeSize() . " for $" . $products->get('A')->getVolumePrice();
		}
		echo "</br>";
		echo "B           | $" . $products->get('B')->getPrice() . " each";
		if($products->get('B')->isVolumeSale()){
			echo " or ". $products->get('B')->getVolumeSize() . " for $" . $products->get('B')->getVolumePrice();
		}
		echo "</br>";
		echo "C           | $" . $products->get('C')->getPrice() . " each";
		if($products->get('C')->isVolumeSale()){
			echo " or ". $products->get('C')->getVolumeSize() . " for $" . $products->get('C')->getVolumePrice();
		}
		echo "</br>";
		echo "D           | $" . $products->get('D')->getPrice() . " each";
		if($products->get('D')->isVolumeSale()){
			echo " or ". $products->get('D')->getVolumeSize() . " for $" . $products->get('D')->getVolumePrice();
		}
		echo "</br>";
		echo "E           | $" . $products->get('E')->getPrice() . " each";
		if($products->get('E')->isVolumeSale()){
			echo " or ". $products->get('E')->getVolumeSize() . " for $" . $products->get('E')->getVolumePrice();
		}
		echo " AND if buy one B get one E for free</br>";


		
		if (isset($_POST["check-out"])) {
			$products = $_POST["product_input"];
			for ($i = 0; $i < strlen($products); $i++) {
				if ($products[$i] != " "){
					$scannable = $terminal->scan($products[$i]);
				}
				if (!$scannable){
					echo "Product not exist or stock not enough for Poduct: " . $products[$i] . "<br>";
				}
			}
			echo "<p>the total price is $" . $terminal->getResult(). ". </p>";
			$terminal_string = serialize($terminal);
        	$_SESSION['terminal_string'] = $terminal_string;
		}

		if (isset($_POST['set_price'])) {
			$code = $_POST["price_code"];
			$price = $_POST["price_input"]; 
			$product_inventory = $terminal->setPricing($code, $price);
			$terminal_string = serialize($terminal);
        	$_SESSION['terminal_string'] = $terminal_string;
		}

		if (isset($_POST['set_vol_size'])) {
			$code = $_POST["vol_size_input_code"];
			$size = $_POST["vol_size_input"]; 
			$product_inventory = $terminal->setVolumeSize($code, $size);
			$terminal_string = serialize($terminal);
        	$_SESSION['terminal_string'] = $terminal_string;
		}

		if (isset($_POST['set_vol_price'])) {
			$code = $_POST["vol_price_code"];
			$price = $_POST["vol_price_input"]; 
			$product_inventory = $terminal->setVolumePricing($code, $price);
			$terminal_string = serialize($terminal);
        	$_SESSION['terminal_string'] = $terminal_string;
		}

		if (isset($_POST['set_stock'])) {
			$code = $_POST["stock_code"];
			$stock = $_POST["stock_input"]; 
			$product_inventory = $terminal->setStock($code, $stock);
			$terminal_string = serialize($terminal);
        	$_SESSION['terminal_string'] = $terminal_string;
		}
        

	?>
</div>
  <h1>Question</h1>
  <pre>Consider a store where items have prices per unit but also volume prices. For example, apples may be $1.00 each Or 4 for $3.00.

Implement a point-of-sale scanning API that accepts an arbitrary ordering of products (similar to what would happen at a checkout line) and then returns the correct total price for an entire shopping cart based on the per unit prices or the volume prices as applicable.

Here are the products listed by code and the prices to use:
Product Code | Price
--------------------
A            | $2.00 each or 4 for $7.00
B            | $10.00
C            | $1.25 or $6 for a six pack
D            | $0.15
E	     | $2 AND if buy one B get one E for free 

*Sales Tax will be 10% of total price for all items.

There should be a top level point of sale terminal service object that looks something like the pseudo-code below. You are free to design and implement the rest of the code however you wish, including how you specify the prices in the system:

terminal->setPricing(...)
terminal->scan("A")
terminal->scan("C")
... etc.
result = terminal->total

Here are the minimal inputs you should use for your test cases. These test cases must be shown to work in your program:

Scan these items in this order: ABCDABAA; Verify the total price is $31.24.
Scan these items in this order: CCCCCC; Verify the total price is $6.6.
Scan these items in this order: ABCD; Verify the total price is $14.74.
Scan these items in this order: ACDE; Verify the total price is $5.94. 


</pre>


</body>
</html>