<?php snippet('header') ?>
<?php
  $collection = $page->siblings()->listed()->sortBy('date', 'desc');
?>
<main class="blog-post mb-10 mr-4 ml-4 lg:mr-0 lg:ml-0">
  <h1 class="mb-2"><?= $page->title() ?></h1>
  <time class="mb-8 block font-extralight text-sm">
    <?= $page->published()->toDate("F j, Y") ?>
  </time>
  <?php if($page->featuredMedia()->toFile()): ?>
    <?php if($page->featuredMedia()->toFile()->type() =='image'): ?>
      <figure class="mb-6">
        <img src="<?= $page->featuredMedia()->toFile()->url() ?>" class="rounded-lg shadow-2xl mb-3" alt="<?= $page->featuredMedia()->toFile()->alt() ?>" />
        <figcaption><?= $page->featuredMedia()->toFile()->caption() ?></figcaption>
      </figure>
    <?php endif ?>
    <?php if($page->featuredMedia()->toFile()->type() =='video'): ?>
    <figure class="mb-6">
      <video
        src="<?= $page->featuredMedia()->toFile()->url() ?>"
        class="rounded-lg shadow-2xl mb-3"
        autoPlay
        loop
        muted
        playsInline
      ></video>
      <figcaption><?= $page->featuredMedia()->toFile()->caption() ?></figcaption>
    </figure>
    <?php endif ?>
  <?php endif ?>
  <?= $page->postcopy()->kirbytext() ?>
  <hr />

  <!-- <button id="likeThisPost" data-uuid="<?= $page->uuid() ?>"  class="bg-black dark:bg-white text-white dark:text-black p-3 rounded-sm mLg:rounded-l-none sub-button">
    Like this post
  </button> -->

  <div class="flex flex-col sm:flex-row text-center text-sm mb-10 mr-4 ml-4 lg:mr-0 lg:ml-0" style="<?php echo ($page->prev($collection)) ? 'justify-content: space-between' : 'justify-content: flex-end'; ?>">

  <?php if($prev = $page->prev($collection)): ?>
      <p class="font-sans">
        Previous: <a href=<?= $prev->url() ?>><?= $prev->title() ?></a>
      </p>
    <?php endif ?>

    <?php if($next = $page->next($collection)): ?>
      <p class="font-sans">
        Next: <a href=<?= $next->url() ?>><?= $next->title() ?></a>
      </p>
    <?php endif ?>
  </div>
</main>
<script src="../../assets/js/like.js"></script>
<?php snippet('footer') ?>
