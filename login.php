<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<h1>Welcome to web chatting</h1>
<form action="loginController.php" method="post">
    <fieldset>
        <legend>Log In</legend>
        <label for="username">Username:</label>
        <input type="text" name="username" /><br />
        <label for="password">Password:</label>
        <input type="password" name="password" />
    </fieldset>
<input type="submit" name="Login" value="Login">
</form>


<form action="signup.php" method="post">
    <fieldset>
        <Legend>Sign Up</legend>
        <label for="username">Username:</label>
        <input type="text" name="username" /><br />
        <label for="passw">Password:</label>
        <input type="password" name="passw"  /> <br/>
        <label for="passm">Confirm Password:</label>
        <input type="password" name="passm"  />
    </fieldset>
        <input type="submit" name="submit">
</form>


</html>