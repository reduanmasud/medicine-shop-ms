
<pre>
<?php
    require_once 'config.php';
    require_once 'classes/User.php';
    require_once 'classes/DBConnect.php';
    if(isset($_POST['submit']))
    {
        var_dump($_POST);
        $user->register($_POST);
    }
?>
</pre>

<form action="" method="POST">
First Name: <input type="text" name="first_name" id=""> <br>
Last Name: <input type="text" name="last_name" id=""> <br>
Email: <input type="email" name="email" id=""> <br>
Password: <input type="password" name="password" id=""> <br>
<input type="submit" name="submit" value="Create Shop">
</form>