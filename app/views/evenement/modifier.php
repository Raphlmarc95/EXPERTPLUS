<div class="row">
  <div class="columns large-12 medium-12">
    <h1>Evenement notify </h1>
  </div>


<?php foreach ($notifications as $key ): ?>
	<?php echo $key->nbr_notify; ?>
	<?php echo $key->event_notify[0]->titre; ?>
<?php endforeach ?>

<span><pre><?php var_dump($notifications); ?></pre></span>
