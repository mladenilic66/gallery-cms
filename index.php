<?php

include("includes/header.php");

$pagi = new Paginate;
$pe = $pagi->per_page;
if (isset($_REQUEST['options']) && !empty($_GET['per_page'])) { $pe = (int)$_GET['per_page']; }

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$total = Photo::countRecords();
$paginate = new Paginate($page,$pe,$total);

if (!empty($_GET['search'])) {
	$search = mysqli_real_escape_string($database->connection,$_GET['search']);
	$photos = Photo::findQuery('SELECT * FROM photos WHERE title LIKE "%'.$search.'%" ORDER BY created DESC');
} else {
	$photos = Photo::findQuery('SELECT * FROM photos ORDER BY created DESC LIMIT '. $pe . ' OFFSET ' . $paginate->offset());
}

if ($total > 0):

?>
    <!-- Page Content -->
    <div class="ui container">

		<div class="row">
			<div class="ui sticky">
				<div id="filter-form" class="ui segment">
					
					<a id="filter-button" href="#" class="ui item"><i class="sliders large black icon"></i></a>

		        	<form id="options-form" class="ui form" action="" method="get">
		        		<div class="fields">
			        		<div class="twelve wide field">
								<label>Search</label>
								<input type="search" name="search" value="<?=(!empty($_GET['search'])) ? safe_input($_GET['search']) : ''?>" placeholder="Search">
							</div>
							<div class="two wide field">
								<label>Per Page</label>
								<input type="number" name="per_page" min="0" max="500" value="<?=(empty($pe)) ? $pagi->per_page : $pe?>">
							</div>
							<div class="two wide field">
								<label>&nbsp;</label>
								<input form="options-form" class="ui inverted fluid blue button" type="submit" name="options" value="Filter">
							</div>
						</div>
		            </form>
				</div>
			</div>

			<div class="ui hidden divider"></div>

			<div class="ui three column doubling stackable relaxed masonry grid" id="example1">

				<?php foreach ($photos as $photo): ?>
			  	<div class="column">
					<div class="ui link cards">
				    	<div class="ui fluid card">
					    	<a href="<?=ROOT?>photos/<?=$photo->id?>" class="image">
								<img src="<?=ADMIN.$photo->photoPath()?>" alt="<?=$photo->title?>">
							</a>

					      	<div class="content">
					        	<a href="<?=ROOT?>photos/<?=$photo->id?>" class="header"><?=$photo->title?></a>
					        	<br>
					        	<div class="meta">
		      						<span><?=time_ago(strtotime($photo->created))?></span>
		    					</div>
		    					<p title="Read More" class="description"><?=excerpt(html_entity_decode($photo->description),600)?></p>
		    			    </div>
		    			    <div class="content">
		    			    	<!-- <span class="right floated"><i class="heart outline like icon"></i>17 likes</span> -->
    							<span class="left floated"><i class="comment-icon outline comment icon"></i><?=Photo::countPhotoComments($photo->id)?></span>
		    			    </div>
					    </div>
					</div>
			  	</div>
			  	<?php endforeach; ?>

			</div>

		<div class="ui hidden divider"></div>
		
		<?php if ($total >= $pe): ?>
			
    	<!-- Pagination -->
		<div class="ui center aligned container">

			<?php if ($paginate->totalPages() > 1): ?>
				
				<div class="ui stackable pagination menu">

					<?php if ($paginate->hasPrev()): ?>
						<a href="<?=ROOT?>?page=<?=$paginate->prev()?>&per_page=<?=$pe?>&options=Submit" class="item">Previous</a>
					<?php endif; ?>


					<?php for ($p=1; $p <= $paginate->totalPages(); $p++):

						if ($p == $paginate->page): ?>

							<a class="active item" href="<?=ROOT?>?page=<?=$p?>&per_page=<?=$pe?>&options=Submit"><?=$p?></a>

						<?php else: ?>

							<a class="item" href="<?=ROOT?>?page=<?=$p?>&per_page=<?=$pe?>&options=Submit"><?=$p?></a>

						<?php endif; ?>

						
					<?php endfor; ?>

					<?php if ($paginate->hasNext()): ?>
						<a class="item" href="<?=ROOT?>?page=<?=$paginate->next()?>&per_page=<?=$pe?>&options=Submit">Next</a>
					<?php endif; ?>
				</div>

			<?php endif; ?>
		</div>
		
		<?php endif; ?>

	<?php endif; ?>

</div>

	</div>

<?php include("includes/footer.php"); ?>