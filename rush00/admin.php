<?php
session_start();
if (!$_SESSION["admin"])
	header("Location: index.php");
include("header.php");
?>
<main class="content">
<h1>ADMIN</h1>
<?php

if (file_exists("./private/user"))
{
	$tab = unserialize(file_get_contents("./private/user"));
	echo "<form action='moduser.php' method='POST' class='tab'><table>";
	echo "<h3>users</h3>";
	echo "<tr><th>id</th>
					<th>email</th>
					<th>first name</th>
					<th>last lname</th>
					<th>admin</th>
					<th>bannes</th>
					<th></th>
					<th></th></tr>";
	foreach ($tab as $user)
	{
		echo "<tr><td><input type='number' name=".$user["id"]." value=".$user["id"]." readonly></td>";
		echo "<td><input type='email' name='email".$user["id"]."' value=".$user["email"]."></td>";
		echo "<td><input type='text' name='fname".$user["id"]."' value=".$user["fname"]."></td>";
		echo "<td><input type='text' name='lname".$user["id"]."' value=".$user["lname"]."></td>";
		echo "<td><input type='checkbox' name='admin".$user["id"]."' value='admin'";
		if ($user["admin"])
			echo " checked";
		echo "></td><td><input type='checkbox' name='banned".$user["id"]."' value='banned'";
		if ($user["banned"])
			echo " checked";
		echo "></td><td><input type='submit' name='submit".$user["id"]."' value='apply'></td>";
		echo "<td><input type='submit' name='delete".$user["id"]."' value='delete'><td>";
	}
	echo "</table></form>";
	foreach ($tab as $user)
	{
		if ($user["orders"])
		{
			?>
			<form action="#" method="post" class="tab">
			<h3>User <?php echo $user["email"]?> orders</h3>
			</form>
			<?php
			foreach ($user["orders"] as $order) {
				?>
				<form action="#" method="post" class="tab">
				<table>
				<tr>
					<th>Product</th>
					<th>Quantity</th>
					<th>Price</th>
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

