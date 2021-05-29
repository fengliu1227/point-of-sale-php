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

  <?php
  session_start();
  if (isset($_SESSION['terminal_string'])) {
    echo '有值';
    echo $_SESSION['terminal_string'];
  }
    echo "CNM1";
  $terminal = unserialize($_SESSION['terminal_string']);//反序列化
   echo $terminal;
    echo "CNM";

  ?>