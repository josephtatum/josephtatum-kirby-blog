<html lang="en" class="bg-white text-black dark:text-white dark:bg-black hidden">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $site->title() ?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="../../assets/js/subscribe.js"></script>
    <?= css('assets/css/styles.css') ?>
    <?= css('assets/css/blog-detail.css') ?>
    <?= css('assets/css/base.css') ?>
    <?php snippet('last-fm-now-playing') ?>
  </head>
  <body class="p-4 mx-auto max-w-screen-md">
  <header>
      <a href="/">
        <img src="../../assets/joseph-animated.png" class='w-24 mb-5' />
      </a>

      <p class='font-sansBold'>Joseph Tatum</p>
      <p class="mb-5">
        is blogging and <?= getLastFm(); ?>
      </p>
      
      <form action="/subscribe" method="POST" class="signup-form mLg:flex">
        <input
            type="email"
            id="email"
            name="email"
            placeholder="you@youremail.com"
            class="bg-white dark:bg-black border-2 dark:border-white text-black dark:text-white p-3 rounded-sm mb-2 mLg:mb-0 mLg:rounded-r-none flex-1 mLg:border-r-0 sub-input"
        />
        <input type="hidden" name="honeypot" value="" />
        <button id="submit" type="submit" class="bg-black dark:bg-white text-white dark:text-black p-3 rounded-sm mLg:rounded-l-none sub-button disabled:bg-slate">
            Subscribe
        </button>
      </form>

      <p id="message" style="display: hidden"></p>

      <hr class="mt-10 mb-10 text-gray" />
    </header>