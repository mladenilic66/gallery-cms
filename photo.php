<?php

include ("includes/header.php");

$photo = Photo::fetchPhotos($_GET['id']);

if (empty($_GET['id']) || $photo == false) { redirect(ROOT); } else {

    if (isset($_POST['submit_comment']) && !empty($_POST['author']) && !empty($_POST['body'])) {

        $author = $_POST['author'];
        $body   = $_POST['body'];
        $new_comment = Comment::createComment($photo->id,$author,$body);

        if ($new_comment && $new_comment->save()) {

            Messages::setMsg('Comment has been submitted successfully','success');
        } else {

            Messages::setMsg('There was some problem while saving the comment','error');
        }
    }

    if (isset($_POST['submit_comment']) && empty($_POST['author']) && empty($_POST['body'])) {

        Messages::setMsg('Please fill out all the fileds','error');
    }

    $all_comments = Comment::fetchComment($photo->id);
}

?>
    <!-- Page Content -->
    <div class="ui container">
        
        <div class="row">
            <?php Messages::display(); ?>
            <!-- Title -->
            <h1 class="ui left floated header"><?=$photo->title?> </h1>
            <?php if ($session->isLoggedIn()): ?>
                <a href="<?=ADMIN?>edit_photos?id=<?=$photo->id?>" class="ui right floated inverted blue labeled icon button"><i class="edit icon"></i>Edit</a>
            <?php endif; ?>
            
            <div class="ui clearing hidden divider"></div>

            <div class="ui left aligned segment">
                <div class="ui breadcrumb">
                    <!-- Author -->
                    <span class="author">by <a href="#"><?=$photo->author_first_name.' '.$photo->author_last_name?></a></span>
                    <!-- Date/Time -->
                    <div class="divider">&nbsp; | &nbsp;</div>
                    <span class="date"> <?=date_short($photo->created)?></span>
                </div>
            </div>

            <div class="ui hidden divider"></div>

            <!-- Preview Image -->
            <img class="img-responsive" src="<?=ADMIN.$photo->photoPath()?>" alt="<?=$photo->title?>">

            <!-- Post Content -->
            <?php if (!empty($photo->caption)): ?>

                <h3 class="ui header"><?=$photo->caption?></h3>

            <?php endif; ?>

            <div class="ui hidden divider"></div>
            <div class="ui container description-content"><?=html_entity_decode($photo->description)?></div>
            <div class="ui hidden divider"></div>
            <a name="comment_anchor" style="visibility: hidden;">Comments</a>
            <div class="ui horizontal divider">Comments</div>

            <!-- Blog Comments -->
            <div class="ui comments">

                <!-- Comment -->
                <?php foreach ($all_comments as $single_comment): ?>

                <div class="comment">
                    <a class="avatar"><img class="ui small image" src="https://ui-avatars.com/api/?name=<?=$single_comment->author?>&background=<?=rand_color()?>&color=fff" alt="visitor"></a>
                    <div class="content">
                        <a class="author"><?=$single_comment->author?></a>
                        <div class="metadata">
                            <div class="date"><?=date_short($single_comment->created)?></div>
                        </div>

                        <div class="text"><p><?=$single_comment->body?></p></div>
                    </div>
                </div>

                <?php endforeach; ?>

                <div class="ui hidden divider"></div>

                <!-- Comments Form -->
                <form action="" class="ui reply form" method="post">
                    <div class="field">
                        <input type="text" name="author" placeholder="Name">
                    </div>
                    <div class="field">
                        <textarea name="body" placeholder="Comment"></textarea>
                    </div>
                    <button class="ui labeled primary icon button" name="submit_comment" type="submit"><i class="plus icon"></i>Add Comment</button>
                </form>
            </div>
        </div><!-- /.row -->
        
    </div>

<?php include ("includes/footer.php"); ?>