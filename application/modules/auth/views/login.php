<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="<?php echo base_url() ?>auth/login_action" method="post">
      <table>
        <tr>
          <td>username</td>
          <td><input type="text" name="username"> </td>
       </tr>
       <tr>
      <td>password</td>
      <td><input type="text" name="password"> </td>
       </tr>
       <tr>
         <td><input type="submit" value="login"></td>
       </tr>

      </table>
    </form>
    <p>Status Saat ini : <?php echo "$status"; ?></p>
  </body>
</html>
