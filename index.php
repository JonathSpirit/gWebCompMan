<?php

include "private/constant.php";

session_start();

if ( !isset($_SESSION['page']) )
{
  $_SESSION['page'] = 0;
}

if ( !isset($_SESSION['search_type']) )
{
  $_SESSION['search_type'] = "%";
}
if ( !isset($_SESSION['search_name']) )
{
  $_SESSION['search_name'] = "%";
}
if ( !isset($_SESSION['search_desc']) )
{
  $_SESSION['search_desc'] = "%";
}
if ( !isset($_SESSION['search_pkg']) )
{
  $_SESSION['search_pkg'] = "%";
}
if ( !isset($_SESSION['search_store']) )
{
  $_SESSION['search_store'] = "%";
}
if ( !isset($_SESSION['search_manu']) )
{
  $_SESSION['search_manu'] = "%";
}
if ( !isset($_SESSION['search_loc']) )
{
  $_SESSION['search_loc'] = "%";
}
if ( !isset($_SESSION['search_label']) )
{
  $_SESSION['search_label'] = "%";
}
if ( !isset($_SESSION['search_label2']) )
{
  $_SESSION['search_label2'] = "%";
}

if ( !isset($_SESSION['isAdmin']) )
{
  $_SESSION['isAdmin'] = false;
}

$componentCount = 0;

try
{
  $bdd = new PDO($cfg_mysql_pdo, $cfg_mysql_login, $cfg_mysql_password);
}
catch(Exception $e)
{
  die('Error : '.$e->getMessage());
}

$request = $bdd->prepare("SELECT COUNT(*) FROM components WHERE
  type LIKE ? AND
  name LIKE ? AND
  description LIKE ? AND
  package LIKE ? AND
  store LIKE ? AND
  manufacturer LIKE ? AND
  location LIKE ? AND
  label LIKE ? AND 
  label_extra LIKE ? ");

$request->execute(array(
  $_SESSION['search_type'],
  $_SESSION['search_name'],
  $_SESSION['search_desc'],
  $_SESSION['search_pkg'],
  $_SESSION['search_store'],
  $_SESSION['search_manu'],
  $_SESSION['search_loc'],
  $_SESSION['search_label'],
  $_SESSION['search_label2'] ));

$data = $request->fetch();

$componentCount = (int)$data['COUNT(*)'];

$request->closeCursor();

if ( $componentCount < (10 * $_SESSION['page']) )
{//Out of page
  $_SESSION['page'] = 0;
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
        <h2>web components manager</h2>
        
        <p>
          This is an homemade components manager for stockage management.
          Created by Guillaume Guillet.
        </p>

        <div> 
          <form method="post" action="action/search.php" style="display: inline;">
            <table>
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Package</th>
                  <th>Store</th>
                  <th>Manufacturer</th>

                  <th>Location</th>
                  <th>Label</th>
                  <th>Label extra</th>
                </tr>
              </thead>
            <tbody>
                <tr>
                    <td> <input class="text-search" type="text" name="search_type" value="<?php echo $_SESSION['search_type']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_name" value="<?php echo $_SESSION['search_name']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_desc" value="<?php echo $_SESSION['search_desc']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_pkg" value="<?php echo $_SESSION['search_pkg']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_store" value="<?php echo $_SESSION['search_store']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_manu" value="<?php echo $_SESSION['search_manu']; ?>" /> </td>

                    <td> <input class="text-search" type="text" name="search_loc" value="<?php echo $_SESSION['search_loc']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_label" value="<?php echo $_SESSION['search_label']; ?>" /> </td>
                    <td> <input class="text-search" type="text" name="search_label2" value="<?php echo $_SESSION['search_label2']; ?>" /> </td>
                </tr>
              </tbody>
            </table>

            <input type="submit" value="search" />
          </form>

          <form method="post" action="action/search_clear.php" style="display: inline;">
            <input type="submit" value="clear" />
          </form>
        </div>

        <br><br>

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

              <?php
              if ( $_SESSION['isAdmin'] )
              {
                ?>
                <th></th>
                <?php
              }
              ?>
            </tr>
          </thead>
        <tbody>
              <?php

              $limit_min = $_SESSION['page'] * 10;
              $limit_max =  min( $componentCount - $limit_min, 10 );

              $request = $bdd->prepare("SELECT * FROM components WHERE
                type LIKE ? AND
                name LIKE ? AND
                description LIKE ? AND
                package LIKE ? AND
                store LIKE ? AND
                manufacturer LIKE ? AND
                location LIKE ? AND
                label LIKE ? AND 
                label_extra LIKE ? ORDER BY type LIMIT ".(int)$limit_min.", ".(int)$limit_max);

              $request->execute(array(
                $_SESSION['search_type'],
                $_SESSION['search_name'],
                $_SESSION['search_desc'],
                $_SESSION['search_pkg'],
                $_SESSION['search_store'],
                $_SESSION['search_manu'],
                $_SESSION['search_loc'],
                $_SESSION['search_label'],
                $_SESSION['search_label2'] ));

              while ($data = $request->fetch())
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

                <?php
                if ( $_SESSION['isAdmin'] )
                {
                ?>
                  <td>
                    <form method="get" action="edit.php">
                      <input type="image" src="icon/edit.png" alt="Edit" width="30px" height="30px">
                      <input type="hidden" name="id" value="<?php echo (int)$data['id']; ?>">
                    </form>
                  </td>
                </tr>
              <?php
                }
              }

              $request->closeCursor();
              ?>
          </tbody>
        </table>

        <p style="display: inline;">
          page : 
          <?php
          for ($i = 0; $i <= ($componentCount/10); $i++)
          {
          ?>
            <form action="action/switch_page.php" method="post" style="display: inline;" >
              <input type="submit" class="text-button" <?php if ($i == $_SESSION['page']) {echo "style=\"color: #FF0000;\"";} ?> value="<?php echo $i; ?>" />
              <input type="hidden" name="newPage" value=<?php echo $i; ?> />
            </form>
          <?php
          }
          ?>
        </p>

        <?php
        if ( $_SESSION['isAdmin'] )
        {
        ?>
        <form method="post" action="add.php" style="display: inline;">
          <input type="submit" value="add new component" />
        </form>
        <?php }?>

        <div> showed components : <?php echo $limit_max; ?> </div>
        <div> total components : <?php echo $componentCount; ?> </div>

        <br>

        <form method="post" action="action/login.php" style="display: inline;" >
          <input type="submit" class="text-button" value="login" />
          <?php
          if ( $_SESSION['isAdmin'] )
          {
            echo "(you are connected)";
          }
          else
          {
            echo "(you are not connected)";
          }
          ?>
        </form>

        <br><br>
        <div>Edit icon is made by <a href="https://www.flaticon.com/authors/creaticca-creative-agency" title="Creaticca Creative Agency">Creaticca Creative Agency</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
    </body>
</html>
