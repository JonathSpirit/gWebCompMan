<?php

session_start();

if ( !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin'] )
{
  die("you are not an admin !");
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
        <h2>web components manager (add)</h2>
        
        <p>
          This is an homemade components manager for stockage management.
          Created by Guillaume Guillet.
        </p>

      <div>
        <form method="post" action="action/add_component.php" style="display: inline;">
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
                <tr>
                  <td> <input class="text-search" type="text" name="edit_type" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_name" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_desc" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_pkg" value="" /> </td>
                  <td> <input class="text-search" type="number" min="0" step="1" name="edit_quantity" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_store" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_ref" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_manu" value="" /> </td>
                  <td> <input class="text-search" type="number" min="0" step="0.01" name="edit_price" value="" /> </td>

                  <td> <input class="text-search" type="text" name="edit_loc" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_label" value="" /> </td>
                  <td> <input class="text-search" type="text" name="edit_label2" value="" /> </td>
                </tr>
            </tbody>
          </table>

          <input type="submit" value="add" />
        </form>

        <form action="index.php" style="display: inline;">
          <input type="submit" value="cancel" />
        </form>
      </div>

    </body>
</html>
