<?php
session_start();
include("header.php");
?>
<main class="content">
<?php
if (file_exists("./private/user"))
{
	$tab = unserialize(file_get_contents("./private/user"));

	foreach ($tab as $user)
	{
		if ($user["email"] == $_SESSION["loggued_on_user"])
			if ($user["orders"])
			{
				?>
				<form action="#" method="post" class="tab">
				<h3>User <?php echo $user["email"]?> orders</h3>
				<?php
				foreach ($user["orders"] as $order) {
					?>
					<table>
					<tr>
						<th scope="col">Product</th>
						<th scope="col">Quantity</th>
						<th scope="col">Price</th>
					</tr>
					<?php
					foreach ($order as $item) {
						if ($item["name"])
						{
						?>
						<tr>
							<td><?PHP echo $item["name"]; ?></td>
							<td><input type="text" value="1" class="qty" readonly></td>
							<td><?PHP echo $item["price"]; ?> USD</td>
						</tr>
						<?php
						}
					}
					?>
					<tr><th>Subtotal: <?php echo $order["subtotal"]." USD"; ?></th><?php  ?></tr>
					</table>
					<!-- <input type="submit" value="delete" name="delete" /> -->
					</form>
					<?php
				}
		}
	}
}
?>
</main>
<?php include("footer.php"); ?>
