<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

    redirect('Welcome', 'reload');
}
?>
<head>
    <title>Contact Crud</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Login</h1>
<div class="row">

    <form action="<?php echo base_url()?>/index.php/Login/authenticate" class="form" roles="form" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button class="btn btn-success">Login</button>
        </div>
    </form>



</div>
</div>
</body>
</html>