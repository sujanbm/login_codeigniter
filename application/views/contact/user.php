
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
                <img width="50%" height="auto" src="<?php echo base_url()?>/uploads/<?php echo $file->file_name ?>"/>
            </a>

        </div>
        <?php } ?>




        <form class = "form" action="<?php echo site_url()?>/Welcome/multiple_upload/<?php echo $user->id ?>" method = "POST" enctype="multipart/form-data">

            <div class="form-group">
                <input type="file" name="files[]"  multiple id="files">
            </div>

            <div class="form-group">
                <button class="btn btn-success">Upload</button>
            </div>

        </form>


    </div>
<?php include_once("footer.php");?>