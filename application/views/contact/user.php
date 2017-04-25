
<?php require_once("header.php") ?>
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

                <tr>
                    <td><?php if(file_exists("./uploads/$user->file")){?>
                            <img src="<?php echo base_url();?>/uploads/<?php echo $user->file?>" width="auto" height="75px" alt="">
                        <?php }else{ ?>
                            <img src="<?php echo base_url();?>/uploads/facebook-avatar.jpg?>" width="auto" height="75px" alt="">
                        <?php } ?></td>
                    <td><?php echo $user->first_name; ?></td>
                    <td><?php echo $user->last_name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->phone_number; ?></td>
                    <td> <a href="<?php echo site_url();?>/Welcome/edit/<?php echo $user->id ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                        <a href="<?php echo site_url()?>/Welcome/delete/<?php echo $user->id?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a></td>
                </tr>
        </table>




        <?php foreach ($files as $file){?>
        <div class="col-sm-6 col-md-4">
            <a href="" class="thumbnail">

                <?php if(file_exists("./uploads/$file->file_name")){?>
                    <img src="<?php echo base_url();?>/uploads/<?php echo $file->file_name?>" width="auto" height="200px" alt="">
                <?php }else{ ?>
                    <img src="<?php echo base_url();?>/uploads/facebook-avatar.jpg?>" width="auto" height="200px" alt="">

                    <form class = "form" action="<?php echo site_url()?>/Welcome/file_update/<?php echo $user->id ?>/<?php echo $file->id?>" method = "POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="file" id="file">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" >Update</button>
                        </div>
                    </form>
                <?php } ?>
            </a><br>

            <a href="<?php echo site_url()?>/Welcome/delete_photo/<?php echo $user->id?>/<?php echo $file->id?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this picture?');">Delete</button></a>

        </div>
        <?php } ?>







    </div>

    <?php echo $data; ?>

    <form class = "form" action="<?php echo site_url()?>/Welcome/files_upload/<?php echo $user->id ?>" method = "POST" enctype="multipart/form-data">

        <div class="form-group">
            <input type="file" name="files[]"  multiple id="files">
        </div>

        <div class="form-group">
            <button class="btn btn-success">Upload</button>
        </div>

    </form>
<?php include_once("footer.php");?>