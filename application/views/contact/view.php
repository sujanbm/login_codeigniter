<?php require_once("header.php") ?>
  <div class="row">
   <h1>User List</h1>
<!--   <a href="--><?php //echo site_url();?><!--/Welcome/create"><button type="button" class="btn btn-success">Add User</button></a>-->
   <table class="table table-bordered">
       <tr>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Edit</th>

       </tr>
       <?php foreach ($user_list as $user): ?>
           <tr>
               <td><?php echo $user->first_name; ?></td>
               <td><?php echo $user->last_name; ?></td>
               <td><?php echo $user->email; ?></td>
               <td><?php echo $user->phone_number; ?></td>
               <td> <a href="<?php echo site_url();?>/Welcome/edit/<?php echo $user->id ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url()?>/Welcome/delete/<?php echo $user->id?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a></td>
           </tr>
       <?php endforeach; ?>
   </table>
</div>
<?php include_once("footer.php");
