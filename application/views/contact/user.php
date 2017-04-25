
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
                    <td><img src="<?php echo base_url();?>/uploads/<?php echo $user->file?>" width="100px" height="auto" alt=""></td>
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
                <img width="auto" height="200px" src="<?php echo base_url()?>/uploads/<?php echo $file->file_name ?>"/>
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