<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

$user = new User();

if (isset($_POST['add_user']) && $user) {

    if (empty($_POST['username']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['password'])) {
        
        Messages::setMsg('Fill out all the fields','error');

    } else {

        $user->username   = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->password   = $user->passwordHash($_POST['password']);
        $user->avatar     = $_FILES['avatar'];
        $user->setFile($_FILES['avatar']);
        $user->saveUser();
        $user->save();

        Messages::setMsg('User ' . $user->username . ' has been created successfully','sucess');
    }
}

?>

<div id="dialog" class="ui modal" style="display:none;"></div>

    <div class="pusher">
        <div class="ui container">

            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>

            <div class="ui text container segments">
                <div class="ui inverted padded segment">
                    <h3 class="ui centered header">ADD USER</h3>
                </div>

                <div class="ui very padded piled segment">
                    <form class="ui form" method="post" action="" enctype="multipart/form-data">

                        <?php Messages::display(); ?>

                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Username">
                        </div>

                        <div class="field">
                            <label>First Name</label>
                            <input type="text" name="first_name" placeholder="First Name">
                        </div>

                        <div class="field">
                            <label>Last Name</label>
                            <input type="text" name="last_name" placeholder="Last Name">
                        </div>

                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password">
                        </div>

                        <div class="field">
                            <label for="avatar" class="ui icon basic brown button">
                                <i class="big user circle outline upload icon"></i><p>Avatar</p>
                            </label>
                            <input id="avatar" type="file" name="avatar" style="display:none">
                        </div>

                        <button class="ui black fluid button" type="submit" name="add_user">Submit</button>
                    </form>

                </div>
            </div>

        </div>

<?php include("includes/footer.php"); ?>