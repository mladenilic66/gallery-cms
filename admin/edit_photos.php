<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

if (empty($_GET['id'])) { redirect(ADMIN.'photos.php'); } else {

    $photo = Photo::fetchById($_GET['id']);

    if (isset($_POST['update']) && $photo) {

        $photo->title       = $_POST['title'];
        $photo->caption     = $_POST['caption'];
        $photo->description = $_POST['description'];
        $photo->save();
        Messages::setMsg('Photo '. $photo->title .' has been updated successfully','sucess');
    }
}

?>

    <div class="pusher">
        <div class="ui container">
            <div class="ui breadcrumb">
                <a href="<?=ADMIN?>" class="section">Dashboard</a>
                <div class="divider"> / </div>
                <a class="section back-link">Back</a>
            </div>

            <h1 class="ui dividing header"><a href="<?=ROOT?>photos/<?=$photo->id?>"><?=$photo->title?></a></h1>
            <div class="ui hidden divider"></div>

            <div class="ui relaxed stackable grid">

                <div class="eleven wide column">
                    <form id="update-form" class="ui form" method="post" action="" enctype="multipart/form-data">

                        <?php Messages::display(); ?>

                        <div class="field">
                            <label>Title</label>
                            <input type="text" name="title" value="<?=$photo->title?>">
                        </div>

                        <div class="field">
                            <label>Image</label>

                            <div class="ui fluid card">
                                <div class="image">
                                    <img class="ui centered large image" src="<?=ADMIN.$photo->photoPath()?>" alt="<?=$photo->title?>">
                                </div>

                                <!-- <label id="image-label" for="image" class="center aligned content">
                                    <i class="big cloud upload icon"></i>
                                </label>
                                <input id="image" type="file" name="image" style="display: none;"> -->
                            </div>
                        </div>

                        <div class="field">
                            <label>Caption</label>
                            <input type="text" name="caption" value="<?=$photo->caption?>">
                        </div>

                        <div class="field">
                            <label>Description</label>
                            <textarea id="edit-photo-area" name="description" rows="20"><?=$photo->description?></textarea>
                        </div>

                        <button class="ui blue button" type="submit" name="update">Update</button>
                    </form>
                </div>

                <div class="five wide column">

                    <div class="ui fluid card">
                        <div class="content">
                            <div class="left floated header">Save</div>
                            <div class="right floated meta mini-info"><i class="large angle down link icon"></i></div>
                        </div>

                        <div class="slide-info content">
                            <h4 class="ui left floated sub header">File Info:</h4>
                            <p class="ui right floated"><i class="calendar outline icon"></i><?=date_short($photo->created)?></p>
                            <div class="ui feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="ui hidden divider"></div>
                                        <p><span>Photo Id:</span> <strong><?=$photo->id?></strong></p>
                                        <p><span>Filename:</span> <strong><?=$photo->filename?></strong></p>
                                        <p><span>File Type:</span> <strong><?=strtoupper(pathinfo($photo->photoPath(), PATHINFO_EXTENSION))?></strong></p>
                                        <p><span>File Size:</span> <strong><?=size_converter($photo->size)?></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-info extra content">
                            <a href="<?=ADMIN?>delete.php?del_photo=<?=$photo->id?>" class="ui inverted red button delete-link">Delete</a>
                            <button form="update-form" type="submit" class="ui right floated inverted blue button" name="update">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include("includes/footer.php"); ?>