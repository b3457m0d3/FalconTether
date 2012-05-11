<!-- HTML Code to generate the "view" of page elements. Two column layout with bookmarks on the left and Add bookmarks on the right-->
<div class="leftside">
<?php foreach ($bookmarks as $bookmark): ?>

    <h2><a href="<?php echo $bookmark['link']?>"><?php echo $bookmark['description']?> </a> </h2>
        <h3><?php echo $bookmark['tag'] ?></h3>
	<p><?php echo $bookmark['link']?></p>

<?php endforeach ?>
</div>

<div class="rightside">

</div>
