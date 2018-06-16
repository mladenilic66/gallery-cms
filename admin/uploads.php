<?php include("includes/header.php");

if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

    $msg = [];

    if (isset($_POST['submit_photo'])) {

        if (!empty($_POST['title']) && !empty($_POST['description'])) {
            $photo = new Photo;
            $photo->title       = $_POST['title'];
            $photo->user_id     = $_SESSION['user_info']['id'];
            $photo->description = html_entity_decode($_POST['description']);
            $photo->setFile($_FILES['file_upload']);
            $photo->save() ? Messages::setMsg('Photo Uploaded successfully','success') : $msg = $photo->custom_errors;
        } else {
            Messages::setMsg('Please fill up all the fields','error');
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

            <div class="ui container segments">
                <div class="ui inverted padded segment">
                    <h3 class="ui centered header">Uploads</h3>
                </div>

                <div class="ui very padded piled segment">
                    <form class="ui form" method="post" action="" enctype="multipart/form-data">

                        <?php foreach ($msg as $msg_single): ?>

                            <div class="ui negative small message"><i class="close icon"></i><div class="header"><?=$msg_single?></div></div>

                        <?php endforeach; ?>

                        <?php Messages::display(); ?>

                        <div class="field">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="Title">
                        </div>

                        <div class="field">
                            <label>Description</label>
                            <textarea id="uploads-textarea" name="description" placeholder="Description"></textarea>
                        </div>

                        <div class="field">
                            <label for="file" class="ui icon basic grey button">
                                <i class="big cloud upload icon"></i><p>Image</p>
                            </label>
                            <input id="file" type="file" name="file_upload" style="display:none">
                        </div>

                        <button class="ui black button" type="submit" name="submit_photo">Submit</button>
                    </form>
                </div>
            </div>

        </div>

<?php include("includes/footer.php"); ?>