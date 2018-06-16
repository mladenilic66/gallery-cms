<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }
$comments = Comment::fetchComments();

?>
    <div class="pusher">
        <div class="ui container">
            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>
            <h2 class="ui dividing header">All Comments</h2>
            <div class="ui hidden divider"></div>

            <table class="ui center aligned celled striped padded selectable table">
                <?php Messages::display(); ?>
                <thead>
                    <tr>
                        <th class="single line">Submitted on</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Posted</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td>
                            <a href="<?=ROOT?>photos/<?=$comment->photo_id?>#comment_anchor">
                                <?=(!empty($comment->photo_title)) ? $comment->photo_title : 'N/A'; ?>
                            </a>
                        </td>
                        <td class="single line"><strong><?=$comment->author?></strong></td>
                        <td><?=$comment->body?></td>
                        <td><?=$comment->created?></td>
                        <td class="right aligned">
                            <a class="delete-link" href="<?=ADMIN?>delete.php?del_comment=<?=$comment->id?>"><i class="trash icon"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

<?php include("includes/footer.php"); ?>