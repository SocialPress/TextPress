<script type="text/javascript">
<?php
	
	$gallery = '{}';
	if(!empty($this->data['gallery'])){
		// fetch the gallery
		$handle = fopen($this->data['gallery'], 'r');
		$gallery = stream_get_contents($handle);
		// Set a gallery date (Yr-Mo)
		$galleryDate = substr($this->data['gallery'], -18, 7);
	}
?>
	
var photos = <?php echo $gallery.';' ?>;
	
</script>
<section id="galleries">
<header>
	<h1>Gallery <small><?php echo isset($galleryDate)? $galleryDate:'No Galleries Found'; ?></small></h1>

</header>


<div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery"></div>


<?php

	foreach($this->data['galleries'] as $archived){
		$archiveDate = substr($archived, -18, 7);
		echo $archiveDate;
}


?>
<br>
<footer>

	
</footer>
</section>
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
    </div>
</div>