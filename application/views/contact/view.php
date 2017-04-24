<?php require_once("header.php") ?>
<h3>User List</h3>
<hr>
<br>
  <div class="row">
   <table class="table table-bordered">
       <tr>
           <th>Picture</th>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Edit</th>

       </tr>
       <?php foreach ($results as $user): ?>
           <tr>
               <td><img src="<?php echo base_url();?>/uploads/<?php echo $user->file?>" width="100px" height="auto" alt=""></td>
               <td><?php echo $user->first_name; ?></td>
               <td><?php echo $user->last_name; ?></td>
               <td><?php echo $user->email; ?></td>
               <td><?php echo $user->phone_number; ?></td>
               <td> <a href="<?php echo site_url();?>/Welcome/edit/<?php echo $user->id ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url()?>/Welcome/delete/<?php echo $user->id?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
                    <a href="<?php echo site_url()?>/Welcome/add_photos/<?php echo $user->id ?>"><button class = "btn btn-success">View</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table>
      <p class="pagination"><?php echo $links; ?></p>
</div>
<?php include_once("footer.php");
