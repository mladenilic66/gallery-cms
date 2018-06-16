<?php 
require_once 'init.php';
$user_modal = User::fetchAll();
?>

<div class="ui relaxed modal">

  <i class="close icon"></i>
  <div class="header">Modal Title</div>

  <div class="image content">
    <?php foreach ($user_modal as $modal): ?>
    <div class="image">
      <a role="checkbox" aria-checked="false" tabindex="0" href="#">
        <img class="modal_thumbnails ui bordered small image" src="<?=$modal->avatarPath()?>" data="<?=$modal->id?>">
      </a>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="actions">
    <button id="set-user-img" class="ui button disabled">OK</button>
  </div>

</div>