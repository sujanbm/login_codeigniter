<?php require_once("header.php");?>
<h3>Add Contact</h3>
<div class="row">
       <form action="<?php echo site_url();?>/Welcome/edit_user?id=<?Php $id?>" class="form" role="form" method="post" enctype="multipart/form-data">
           <div class="form-group">
               <label for="first_name">First Name</label>
               <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
           </div>
           <div class="form-group">
               <label for="last_name">Last Name</label>
               <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name;?>" required>
           </div>
           <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>" required>
           </div>
           <div class="form-group">
               <label for="message">Phone</label>
               <input type="text" class= "form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number?>" required>
           </div>
           <div class="form-group">
               <input type="file" name="file" id="file">
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>

           <input type="hidden" name="id" value="<?php echo $id ?>">
       </form>
   </div>
<?php require_once("footer.php");?>
