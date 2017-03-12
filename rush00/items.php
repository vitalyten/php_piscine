<div class="items">
<?php
if (!file_exists("./private/item"))
{
	echo "<h2>Error: No Item Data!</h2>";
	exit();
}
else
{
	$items = unserialize(file_get_contents("./private/item"));
	$categories = array();
			foreach ($items as $item)
			{
				if(isset($item['category']))
				{
					foreach ($item['category'] as $category)
					{
						if(!in_array($category, $categories))
							$categories[] = $category;
					}
				}
				?>
				<div class="item">
					<h2 class="item-header"><?PHP echo $item["name"]; ?></h2>
					<form class="item-container" action="addtocart.php" method="POST">
						<h2 class="item-price">$<?PHP echo $item["price"]; ?></h2>
						<img src="
						<?php if (file_exists($item["path"]))
								echo $item["path"];
							else
								echo "images/metaguy.png";
						 ?>
						 "></img>
						 <p class='item-description'><?PHP echo $item["description"]; ?></p>
						 <input type="hidden" name="item" value="<?php echo $item["name"]; ?>">
				    <p><input type="submit" name="submit" value="Add to cart"></p>
					</form>
				</div>
				<?php
			}

}
?>
</div>
<?php
echo "<form action='#' method='POST' class='tab'><table><tr>";
foreach ($categories as $category)
	echo "<th><a href='category.php?category=$category'>".$category."</a></th>";
echo "</tr></form></table>";
 ?>
