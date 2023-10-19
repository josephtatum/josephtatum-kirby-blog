<?php snippet('header') ?>
<main class="content-container blog-list">
  <ul>
  <?php foreach($site->find('posts')->children()->sortBy('published', 'desc') as $subpage): ?>
  <li class="mb-4 text-xl">
    <a href="<?= $subpage->url() ?>">
    <span class="font-sansLight">
      <?= $subpage->published()->toDate("F j, Y") ?>:
    </span>
    <span class="font-sansBold">
      <?= $subpage->title() ?>
    </span> 
    </a>
  </li>
  <?php endforeach ?>
</ul>
</main>
<?php snippet('footer') ?>
