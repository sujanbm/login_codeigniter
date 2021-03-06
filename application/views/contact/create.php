<?php require_once("header.php");?>
<h3>Add Contact</h3>
<hr>
<br>
<div class="row">

       <form action="<?php echo site_url();?>/Welcome/add_user" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
           <div class="form-group">
               <label for="first_name">First Name</label>
               <?php echo form_error('first_name') ?>
               <input type="text" class="form-control" id="first_name" name="first_name" required>
           </div>
           <div class="form-group">
               <label for="last_name">Last Name</label>
               <?php echo form_error('last_name')?>
               <input type="text" class="form-control" id="last_name" name="last_name" required>
           </div>
           <div class="form-group">
               <label for="email">Email</label>
               <?php echo form_error('email')?>
               <input type="email" class="form-control" id="email" name="email" required>
           </div>
           <div class="form-group">
               <label for="password">Password</label>
               <?php echo form_error('password')?>
               <input type="password" class="form-control" id="password" name="password" required>
           </div>
           <div class="form-group">
               <label for="passconf">Password Confirmation</label>
               <?php echo form_error('passconf') ?>
               <input type="password" class="form-control" id="passconf" name="passconf" required>
           </div>
           <div class="form-group">
               <label for="message">Phone</label>
               <?php echo form_error('phone_number') ?>
               <input type="text" class= "form-control" id="phone_number" name="phone_number" required>
           </div>
           <div class="form-group">
               <label for="file">Profile Picture</label><br>
               <input type="file" name="file"  id="file">
           </div>
           <div class="form-group">
               <label for="photos">Additional Photos</label><br>
               <input type="file" name="files[]" multiple id="files">
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>

<script type="text/javascript">
    $(document).ready(function(){
        var dataString = $("#FormId").serialize();
        var url= "Welcome/add_user";
        $.ajax({
            type:"POST",
            url:"<?php echo site_url() ?>"+url,
            data:dataString,
            success:function (data) {
                alert(data);
            }
        });
    })
</script>
<?php require_once("footer.php");?>
