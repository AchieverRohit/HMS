

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="row">
                <!-- Admin Information -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Admin Information</h4>
                            <p><strong>Name:</strong> <?php echo e($LoggedAdminInfo->name); ?></p>
                            <p><strong>Email:</strong> <?php echo e($LoggedAdminInfo->email); ?></p>
                            <p><strong>Bio:</strong> <?php echo e($LoggedAdminInfo->bio); ?></p>
                            <p><strong>Picture:</strong></p>

                            <?php if($LoggedAdminInfo->picture): ?>
                            <div style="max-width: 300px; margin: auto;">
                                <!-- Adjust max-width and margin as needed -->
                                <img src="<?php echo e(asset('/images/profile_pictures/profile.webp')); ?>"
                                    class="img-fluid rounded" alt="Admin Picture"
                                    style="max-width: 50%; height: auto;">
                            </div>
                            <?php else: ?>
                            <p>Admin Picture not available</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Profile Update Form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Profile</h4>
                            <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="<?php echo e($LoggedAdminInfo->name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input disabled type="email" id="email" name="email"
                                        class="form-control" value="<?php echo e($LoggedAdminInfo->email); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea id="bio" name="bio"
                                        class="form-control"><?php echo e($LoggedAdminInfo->bio); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Profile Picture</label>
                                    <input type="file" id="picture" name="picture"
                                        class="form-control-file">
                                </div>
                                <!-- Add more fields (image upload, etc.) as needed -->

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

    <!-- partial -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\project_name\resources\views/admin/profile.blade.php ENDPATH**/ ?>