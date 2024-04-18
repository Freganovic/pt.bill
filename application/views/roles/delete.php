<?php
// Assuming you have a controller method to handle the delete functionality
// In your controller, you might have a method like this:
// public function deleteRole($roleId) {
//    // Perform deletion logic here
// }

$roleId = $roleInfo->roleId;
$role = $roleInfo->role;
$status = $roleInfo->status;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Roles Management
            <small>Add / Edit / Delete Role</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Role Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>roles/editRole" method="post" id="editRole"
                        role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role Text</label>
                                        <input type="text" class="form-control required" value="<?php echo $role; ?>"
                                            id="role" name="role" maxlength="50" required />
                                        <input type="hidden" value="<?php echo $roleId; ?>" name="roleId" id="roleId" />
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="<?= ACTIVE ?>" <?php if ($status == ACTIVE) {
                                                  echo "selected=selected";
                                              } ?>>Active</option>
                                            <option value="<?= INACTIVE ?>" <?php if ($status == INACTIVE) {
                                                  echo "selected=selected";
                                              } ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a href="<?php echo base_url() ?>roles/deleteRole/<?php echo $roleId; ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this role?')">Delete</a>
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <!-- ... Your existing code for displaying error and success messages ... -->
            </div>
        </div>

        <!-- ... Your existing code for the Role Access Matrix ... -->

    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/addRole.js" type="text/javascript"></script>