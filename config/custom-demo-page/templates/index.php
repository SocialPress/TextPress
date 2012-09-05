<section id="articles">
<?php
	foreach($articles as $article){
?>
	  <article class="post">
      <header>
        <h2><a href="<?php echo $article['url']; ?>"><?php echo $article['meta']->title; ?></a></h2>
        <span class="date"><?php  echo date($this->data['global']['date.format'], strtotime($article['meta']->date));  ?></span>
	
      </header>

      <section class="content">
        <p><?php echo $article['excerpt']; ?>...</p>
      </section>
      <footer>
      <div class="more"><a href="<?php echo $article['url']; ?>">read on &raquo;</a></div>
      </footer>
      <br />
    </article>
  <?php
	}
  ?>
  <footer></footer>
</section>
