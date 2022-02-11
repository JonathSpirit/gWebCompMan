<?php

include "private/constant.php";

session_start();

if ( !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin'] )
{
  die("you are not an admin !");
}

if ( !isset($_GET['id']) )
{
  die("no id !");
}
else
{
  $id = (int)$_GET['id'];
}

try
{
  $bdd = new PDO($cfg_mysql_pdo, $cfg_mysql_login, $cfg_mysql_password);
}
catch(Exception $e)
{
  die('Error : '.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>web components manager</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <h2>web components manager (edit)</h2>
        
        <p>
          This is an homemade components manager for stockage management.
          Created by Guillaume Guillet.
        </p>

      <div>
        <form method="post" action="action/save_component.php" style="display: inline;">
          <table>
            <thead>
              <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Description</th>
                <th>Package</th>
                <th>Quantity</th>
                <th>Store</th>
                <th>Ref</th>
                <th>Manufacturer</th>
                <th>Price</th>

                <th>Location</th>
                <th>Label</th>
                <th>Label extra</th>
              </tr>
            </thead>
            <tbody>
                <?php

                $request = $bdd->query("SELECT * FROM components WHERE id = ".(int)$id);

                if ($data = $request->fetch())
                {
                ?>
                  <tr>
                    <td><?php echo $data['type']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['description']; ?></td>
                    <td><?php echo $data['package']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td><?php echo $data['store']; ?></td>
                    <td><?php echo $data['store_ref']; ?></td>
                    <td><?php echo $data['manufacturer']; ?></td>
                    <td><?php echo $data['price']; ?></td>

                    <td><?php echo $data['location']; ?></td>
                    <td><?php echo $data['label']; ?></td>
                    <td><?php echo $data['label_extra']; ?></td>
                  </tr>
                <?php
                }

                $request->closeCursor();
                ?>

                <tr>
                  <td> <input class="text-search" type="text" name="edit_type" value="<?php echo $data['type']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_name" value="<?php echo $data['name']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_desc" value="<?php echo $data['description']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_pkg" value="<?php echo $data['package']; ?>" /> </td>
                  <td> <input class="text-search" type="number" min="0" step="1" name="edit_quantity" value="<?php echo (int)$data['quantity']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_store" value="<?php echo $data['store']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_ref" value="<?php echo $data['store_ref']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_manu" value="<?php echo $data['manufacturer']; ?>" /> </td>
                  <td> <input class="text-search" type="number" min="0" step="0.01" name="edit_price" value="<?php echo (float)$data['price']; ?>" /> </td>

                  <td> <input class="text-search" type="text" name="edit_loc" value="<?php echo $data['location']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_label" value="<?php echo $data['label']; ?>" /> </td>
                  <td> <input class="text-search" type="text" name="edit_label2" value="<?php echo $data['label_extra']; ?>" /> </td>
                </tr>
            </tbody>
          </table>

          <input type="submit" value="save" />
          <input type="hidden" name="id" value=<?php echo $id; ?>>
        </form>

        <form action="index.php" style="display: inline;">
          <input type="submit" value="cancel" />
        </form>

        <form method="post" action="action/remove_component.php" style="display: inline;">
          <input type="submit" value="remove component" onclick="return confirm('Are you sure?')" />
          <input type="hidden" name="id" value=<?php echo $id; ?>>
        </form>

      </div>

    </body>
</html>
