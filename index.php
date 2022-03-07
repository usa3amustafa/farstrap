<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "cart");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FarStrap Furniture</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
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
            <a href="#" class="flex-link customize"
              >Customize
              <i class="fas fa-sort-down"></i>
            </a>
            <ul class="dropdown customize-dropdown">
              <li>
                <a href="#" class="dropdown-link"
                  ><p class="link-text">height</p>
                  <input type="text" placeholder="cm"
                /></a>
              </li>
              <li>
                <a href="#" class="dropdown-link"
                  ><p class="link-text">width</p>
                  <input type="text" placeholder="cm"
                /></a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="flex-link collection"
              >Collection
              <i class="fas fa-sort-down"></i>
            </a>


            <ul class="dropdown collection-dropdown">
<?php
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
              <li>
                <a href="product.php?id=<?php echo $row['id']?>" class="dropdown-link"
                  ><?php echo $row["name"]; ?>
                </a>
              </li>
              
<?php
					}
				}
			?>
            </ul>


          </li>

          <li>
            <a href="./shoppingcart.php"
              >Shopping Cart <i class="fas fa-shopping-cart"></i
            ></a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- nav end  -->

    <!-- main start  -->

    <main>
      <div class="container grid">
        <?php
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
        <div class="article article-1">
				<form method="post" action="shoppingcart.php?action=add&id=<?php echo $row["id"]; ?>">

          <div class="article-img">
            <img class="article-img-img" src="img/<?php echo $row["image"]; ?>" alt="" />
          </div>
          <h2 class="article-title"><?php echo $row["name"]; ?></h2>
						<h3 class="article-price">$ <?php echo $row["price"]; ?></h3>

            <input style="margin:0.5rem 0;" type="number" min = "1" name="quantity" value="1"  />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

          <div  class="btns">
            <button name="add_to_cart" type='submit' href="#" class="btn pri-btn"
            >Add To Cart <i class="fas fa-cart-plus"></i
            ></button>
            <a href="product.php?id=<?php echo $row['id']?>" class="btn">More Info</a>
          </div>
        </form>
        </div>
        <?php
					}
				}
			?>
      
      
      </div>
    </main>

    <!-- main end -->

    <footer>
      <div class="container footer">
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
    </footer>
  </body>
</html>
