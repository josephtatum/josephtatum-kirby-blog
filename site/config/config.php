<?php

use Ideneal\EmailOctopus\EmailOctopus;
use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Entity\Contact;

return [
    'home' => 'posts',
    'debug' => env(APP_DEBUG),
    'markdown' => [
      'extra' => true
    ],
    'routes' => [
      [
        'pattern' => 'verify-recaptcha',
        'method' => 'POST',
        'action' => function () {
          $ch = curl_init();
          $secret = env('RECAPTCHA_SECRET');
          
          curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,
            "secret={$secret}&response={$_POST['captchaResponse']}");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          $server_response = curl_exec($ch);

          curl_close($ch);

          return json_encode($server_response);
        }
      ],
      [
        'pattern' => "like/(:any)",
        'method'  => 'POST',
        'action'  => function($uid) {
          $pageuid = $uid;
          $kirby = kirby();
          $liked = $kirby->impersonate(env('LIKE_ACCOUNT_EMAIL'), function () use($pageuid) {
            $post = page('page://' . $pageuid);
            if($post) {
              try {
                $post->increment('likes');
                return $post->likes()->toString();
              } catch(Exception $e) {
                return $e->getMessage();
              }
            }
            return json_encode($post);
          });
          return $liked;
        }
      ],
      [
        'pattern' => 'subscribe',
        'method' => 'POST',
        'action' => function () {
        
          $emailOctopus = new EmailOctopus(env('EMAIL_OCTOPUS_ID'));

          $list = $emailOctopus->getMailingList(env('EMAIL_OCTOPUS_LIST_ID'));

          $contact = new Contact();
          $contact
          ->setEmail($_POST['email'])
          ->setStatus('PENDING');

          $emailOctopus->createContact($contact, $list);

          if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
          } else {
              $data['success'] = true;
              $data['message'] = "Can do! Now could you click the confirmation link in your email? Then we'll be squared away!";
          }
          
          return json_encode($data);
        }
      ],
      [
          'pattern' => '(:any)',
          'action'  => function($uid) {
              $page = page($uid);
              if(!$page) $page = page('posts/' . $uid);
              if(!$page) $page = site()->errorPage();
              if(!$page) $this->next();
              
              return site()->visit($page);
          }
      ],
    ]
  ];