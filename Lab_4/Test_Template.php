<?php
require 'Template.php';

$template = new Template();
$template->set('title', 'My Page');
$template->set('heading', 'Welcome to My Page');
$template->set('message', 'This is a simple template engine in PHP.');

echo $template->render('my_template');
?>