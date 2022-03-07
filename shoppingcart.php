<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "cart");

if (isset($_POST["add_to_cart"])) {
  if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    // if(!in_array($_GET["id"], $item_array_id))
    // {
    $count = count($_SESSION["shopping_cart"]);
    $item_array = array(
      'item_id'      =>  $_GET["id"],
      'item_name'      =>  $_POST["hidden_name"],
      'item_price'    =>  $_POST["hidden_price"],
      'item_quantity'    =>  $_POST["quantity"]
    );
    $_SESSION["shopping_cart"][$count] = $item_array;
    // }
    // else
    // {
    // 	echo '<script>alert("Item Already Added")</script>';
    // }
  } else {
    $item_array = array(
      'item_id'      =>  $_GET["id"],
      'item_name'      =>  $_POST["hidden_name"],
      'item_price'    =>  $_POST["hidden_price"],
      'item_quantity'    =>  $_POST["quantity"]
    );
    $_SESSION["shopping_cart"][0] = $item_array;
  }
}

if (isset($_GET["action"])) {
  if ($_GET["action"] == "delete") {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      if ($values["item_id"] == $_GET["id"]) {
        unset($_SESSION["shopping_cart"][$keys]);
        echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="shoppingcart.php"</script>';
      }
    }
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>FarStrap Furniture</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <script src="./app.js" defer></script>

  <link rel="stylesheet" href="style.css" />


</head>

<body>

  <!-- nav start  -->

  <nav>
    <div class="container nav">
      <h1 class="logo"><a href="./index.php">FarStrap Furniture</a></h1>
      <ul class="navigation">
        <li>
          <a href="#" class="flex-link customize">Customize
            <i class="fas fa-sort-down"></i>
          </a>
          <ul class="dropdown customize-dropdown">
            <li>
              <a href="#" class="dropdown-link">
                <p class="link-text">height</p>
                <input type="text" placeholder="cm" />
              </a>
            </li>
            <li>
              <a href="#" class="dropdown-link">
                <p class="link-text">width</p>
                <input type="text" placeholder="cm" />
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="flex-link collection">Collection
            <i class="fas fa-sort-down"></i>
          </a>


          <ul class="dropdown collection-dropdown">
            <?php
            $query = "SELECT * FROM tbl_product ORDER BY id ASC";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
            ?>
                <li>
                  <a href="product.php?id=<?php echo $row['id'] ?>" class="dropdown-link"><?php echo $row["name"]; ?>
                  </a>
                </li>

            <?php
              }
            }
            ?>
          </ul>


        </li>

        <li>
          <a href="./shoppingcart.php">Shopping Cart <i class="fas fa-shopping-cart"></i></a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- nav end  -->

  <div class="container">
    <h3>Order Details</h3>
    <div class="table-responsive" style="height : 100vh;">
      <table class="table table-bordered">
        <tr>
          <th width="40%">Item Name</th>
          <th width="10%">Quantity</th>
          <th width="20%">Price</th>
          <th width="15%">Total</th>
          <th width="5%">Action</th>
        </tr>
        <?php
        if (!empty($_SESSION["shopping_cart"])) {
          $total = 0;
          foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        ?>
            <tr>
              <td><?php echo $values["item_name"]; ?></td>
              <td><?php echo $values["item_quantity"]; ?></td>
              <td>$ <?php echo $values["item_price"]; ?></td>
              <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
              <td><a href="shoppingcart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
          <?php
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
          }
          ?>
          <tr>
            <td colspan="3" align="right">Total</td>
            <td align="right">$ <?php echo number_format($total, 2); ?></td>
            <td></td>
          </tr>
        <?php
        }
        ?>

      </table>
    </div>
  </div>
  </div>
  <br />

  <footer style="background-color : #343A40">
    <div class="container">
      <div class="footer">
        <div class="about-us">
          <h3 class="footer-title">About Us</h3>
          <p class="footer-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam
            repudiandae consectetur blanditiis eaque, dolor odit.
          </p>
        </div>
        <div class="contact">
          <h3 class="footer-title">Contact Us</h3>
          <ul class="contact-info">
            <li><b>Email :</b> admin@FarStrap.com</li>
            <li><b>Phone No :</b> +111-222-333</li>
            <li>
              <b>Address :</b> Lorem ipsum dolor sit amet, consectetur
              adipisicing elit. Illum, explicabo.
            </li>
          </ul>
        </div>
        <div class="opening-hours">
          <h3 class="footer-title">Opening Hours</h3>
          <ul class="opening-hours-info">
            <li>
              <b>Mon - Wed</b> <br />
              11am - 08pm
            </li>
            <li>
              <b>Thu , Fri</b><br />
              12pm - 10pm
            </li>
            <li>
              <b>Sat , Sun</b><br />
              01pm - 12am
            </li>
          </ul>
        </div>
        <div class="social-icons">
          <h3 class="footer-title">Find Us Online</h3>
          <div class="footer-icons">
            <a href="#">
              <i class="fab fa-facebook-square social"></i>
            </a>
            <a href="#">
              <i class="fab fa-instagram social"></i>
            </a>
            <a href="#">
              <i class="fab fa-twitter-square social"></i>
            </a>
            <a href="#">
              <i class="fab fa-pinterest-square social"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>