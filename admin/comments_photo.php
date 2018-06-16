<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

if (empty($_GET['id'])) { redirect(ADMIN.'photos.php'); }

$comment = Comment::fetchComment($_GET['id']);

?>
    <div class="pusher">
        <div class="ui container">
            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>
            <h2 class="ui dividing header">All Comments for: </h2>
            <div class="ui hidden divider"></div>

            <table class="ui celled padded selectable table">
                <?php Messages::display(); ?>
                <thead>
                    <tr>
                        <th>Submitted On</th>
                        <th>Author</th>
                        <th colspan="2">Comment</th>
                        <th>Posted</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($comment as $comm): ?>
                    <tr>
                        <td><a href="<?=ROOT?>photos/<?=$comm->photo_id?>#comment_anchor"><?=$comm->photo_title?></a></td>
                        <td><?=$comm->author?></td>
                        <td><?=$comm->body?></td>
                        <td><a href="<?=ADMIN?>delete.php?del_p_comm=<?=$comm->id?>" class="delete-link"><i class="trash icon"></i></a></td>
                        <td><?=$comm->created?></td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

<?php include("includes/footer.php"); ?>