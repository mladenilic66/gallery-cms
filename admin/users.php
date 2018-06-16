<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }
$users = User::fetchAll();

?>
    <div class="pusher">
        <div class="ui container">
            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>

            <h2 class="ui dividing header">All Users</h2>
            <a href="<?=ADMIN?>add_user.php" class="ui labeled inverted green icon button"><i class="plus icon"></i>Add User</a>
            <div class="ui hidden divider"></div>

            <table class="ui center aligned striped selectable table">
                <?php Messages::display(); ?>

                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><a href="<?=ADMIN?>edit_users.php?id=<?=$user->id?>"><img class="ui tiny circular centered image" src="<?=$user->imageSwitch()?>" alt="<?=$user->username?>"></a></td>
                        <td><?=$user->username?></td>
                        <td><?=$user->first_name?></td>
                        <td><?=$user->last_name?></td>
                        <td>
                            <a href="<?=ADMIN?>edit_users.php?id=<?=$user->id?>"><i class="pencil icon"></i></a>
                            <a class="delete-link" href="<?=ADMIN?>delete.php?del_user=<?=$user->id?>"><i class="trash icon"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        
<?php include("includes/footer.php"); ?>