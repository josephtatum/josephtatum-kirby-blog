<?php

use Ideneal\EmailOctopus\EmailOctopus;
use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Entity\Contact;

return [
    'home' => 'posts',
    'debug' => true,
    'panel' =>[
      'install' => true
    ],
    'markdown' => [
      'extra' => true
    ],
    'routes' => [
      [
        'pattern' => "like/(:any)",
        'method'  => 'POST',
        'action'  => function($uid) {
          $pageuid = $uid;
          $kirby = kirby();
          $liked = $kirby->impersonate('josephtatum+liker@gmail.com', function () use($pageuid) {
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
        
          $emailOctopus = new EmailOctopus('805e74be-e5d7-4c63-a560-773afbb16076');

          $list = $emailOctopus->getMailingList('d5e18337-b947-11ec-9258-0241b9615763');

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