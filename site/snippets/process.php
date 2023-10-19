<?php
use Ideneal\EmailOctopus\EmailOctopus;
use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Entity\Contact;

if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required.';
}

if (empty($_POST['superheroAlias'])) {
    $errors['superheroAlias'] = 'Superhero alias is required.';
}

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
    $data['message'] = 'Success!';
}