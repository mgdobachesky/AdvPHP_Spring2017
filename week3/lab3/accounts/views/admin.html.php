<h1>Admin</h1>
<p><strong>User ID: </strong><?php echo $_SESSION['user_id']; ?></p>
<p><strong>Email: </strong><?php echo $_SESSION['email']; ?></p>

<form action="#" method="post">
    <input type="submit" value="logout" class="btn btn-primary" />
</form>
