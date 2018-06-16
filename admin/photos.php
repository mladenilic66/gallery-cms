<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }
$photos = Photo::fetchAll();

?>
    <div class="pusher">
        <div class="ui container">
            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>
            <h2 class="ui dividing header">All Photos</h2>
            <div class="ui hidden divider"></div>

            <table class="ui center aligned selectable table">
                <?php Messages::display(); ?>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Filename</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th colspan="2">Comments</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($photos as $photo): ?>
                    <tr>
                        <td>
                            <a href="<?=ROOT?>photos/<?=$photo->id?>"><img class="ui tiny image admin-photo" src="<?=ADMIN?><?=$photo->photoPath()?>" alt="<?=$photo->title?>"></a>
                        </td>
                        <td><?=$photo->title?></td>
                        <td><?=excerpt(html_entity_decode($photo->description),100)?></td>
                        <td><?=$photo->filename?></td>
                        <td><?=$photo->type?></td>
                        <td><?=size_converter($photo->size)?></td>
                        <td>
                            <a href="<?=ADMIN?>comments_photo.php?id=<?=$photo->id?>"><?=count(Comment::fetchComment($photo->id))?></a>
                        </td>
                        <td>
                            <a href="<?=ADMIN?>edit_photos?id=<?=$photo->id?>"><i class="pencil icon"></i></a>
                            <a class="delete-link" href="<?=ADMIN?>delete.php?del_photo=<?=$photo->id?>"><i class="trash icon"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

<?php include("includes/footer.php"); ?>