
<?php

if ($_GET['item'] != "" && file_exists("./private/item"))
{
  $tab = unserialize(file_get_contents("./private/item"));
  $i = -1;
  while (++$i < count($tab))
  {
    if ($_GET['item'] == $tab[$i]['name'])
    {
      unset($tab[$i]);
    }
  }
  file_put_contents("./private/item", serialize(array_values($tab)));
}
header("Location: admin.php");
?>

