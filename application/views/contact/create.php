<?php require_once("header.php");?>
<h3>Add Contact</h3>
<div class="row">

       <form action="<?php echo site_url();?>/Welcome/add_user" class="form" role="form" method="post">
           <div class="form-group">
               <label for="first_name">First Name</label>
               <input type="text" class="form-control" id="first_name" name="first_name" required>
           </div>
           <div class="form-group">
               <label for="last_name">Last Name</label>
               <input type="text" class="form-control" id="last_name" name="last_name" required>
           </div>
           <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" name="email" required>
           </div>
           <div class="form-group">
               <label for="password">Password</label>
               <input type="password" class="form-control" id="password" name="password" required>
           </div>
           <div class="form-group">
               <label for="message">Phone</label>
               <input type="text" class= "form-control" id="phone_number" name="phone_number" required>
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>
<?php require_once("footer.php");?>
