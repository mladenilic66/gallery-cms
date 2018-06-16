<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

if (empty($_GET['id'])) { redirect(ADMIN.'users.php'); } else {

    $user = User::fetchById($_GET['id']);

    if (isset($_POST['edit_user']) && $user) {

        $user->username   = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        empty($_POST['password']) ? $user->password = $user->password : $user->password = $user->passwordHash($_POST['password']);

        if (empty($_FILES['avatar'])) {

            $user->save();
        } else {

            $user->setFile($_FILES['avatar']);
            $user->saveUser();
            $user->save();
            Messages::setMsg('User '. $user->username .' has been updated successfully','sucess');
        }
    }
}

?>
    <!-- Modal -->
    <?php include ('includes/modal.php'); ?>

    <div class="pusher">
        <div class="ui container">
            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>

            <h2 class="ui dividing header">Edit User</h2>
            <div class="ui hidden divider"></div>
            <?php Messages::display(); ?>

            <div class="ui relaxed stackable grid">

                <div class="eight wide column">
                    <div class="user-image-box">
                        <a role="checkbox" href="#" ><img class="ui centered circular fluid large image" src="<?=$user->imageSwitch()?>" alt="<?=$user->username?>"></a>
                    </div>
                </div>

                <div class="eight wide column">

                    <form class="ui form" action="" method="post" enctype="multipart/form-data">

                        <div class="field">
                            <label for="avatar" class="ui icon basic brown button">
                                <i class="big user circle outline upload icon"></i><p>Avatar</p>
                            </label>
                            <input id="avatar" type="file" name="avatar" style="display:none">
                        </div>

                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="username" value="<?=$user->username?>">
                        </div>

                        <div class="field">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="<?=$user->first_name?>">
                        </div>

                        <div class="field">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="<?=$user->last_name?>">
                        </div>

                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password">
                        </div>

                        <button class="ui right floated inverted blue button" type="submit" name="edit_user">Update</button>
                        
                        <a id="user-id" href="<?=ADMIN?>delete.php?del_user=<?=$user->id?>" class="ui left floated inverted red button delete-link">Delete</a>

                    </form>

                </div>
            </div>

        </div>

<?php include("includes/footer.php"); ?>