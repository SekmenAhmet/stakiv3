<?php

require '../vendor/autoload.php';

use App\Application;
use App\controllers\FriendsController;
use App\controllers\PageController;
use App\controllers\StaksController;
use App\controllers\UserController;
use App\controllers\AdminController;


$app = new Application();

$app->router->get('/', [StaksController::class, 'getStaks']);
$app->router->post('/', [StaksController::class, 'postStaks']);

$app->router->get('/profil', 'profil');
$app->router->post('/profil', [PageController::class, 'profil']);

$app->router->get('/profilmodif', 'profilmodif');
$app->router->post('/profilmodif', [UserController::class, 'profilmodif']);

$app->router->get('/register', 'register');
$app->router->post('/register', [UserController::class, 'register']);

$app->router->get('/login', 'login');
$app->router->post('/login', [UserController::class, 'login']);

$app->router->post('/logout', [UserController::class, 'logout']);

$app->router->get('/notifs', [PageController::class, 'notifs']);
$app->router->post('/notifs', [FriendsController::class, 'acceptFriend']);

$app->router->get('/friends', [FriendsController::class, 'friends']);
$app->router->post('/friends', [FriendsController::class, 'postfriends']);

$app->router->get('/friendslist', [FriendsController::class, 'friendslist']);
$app->router->post('/friendslist', [FriendsController::class, 'postfriendslist']);

$app->router->get('/searchResult','searchResult');
$app->router->post('/searchResult', [FriendsController::class, 'postSearchResult']);

$app->router->get('/contact','contact');
$app->router->post('/contact', [PageController::class, 'contact']);

$app->router->get('/changemdp','changemdp');
$app->router->post('/changemdp', [UserController::class, 'changemdp']);

$app->router->get('/admin',[AdminController::class, 'getAdmin']);
$app->router->post('/admin', [AdminController::class, 'postAdmin']);

$app->router->get('/adminLogs', [AdminController::class, 'getAdminLogs']);
$app->router->post('/adminLogs', [AdminController::class, 'postAdminLogs']);

$app->router->get('/adminUsers', [AdminController::class, 'getAdminUsers']);
$app->router->post('/adminUsers', [AdminController::class, 'postAdminUsers']);

$app->router->get('/adminFriends', [AdminController::class, 'getAdminFriends']);
$app->router->post('/adminFriends', [AdminController::class, 'adminFriends']);

$app->router->get('/adminFriendRequests', [AdminController::class, 'getAdminFriendRequests']);
$app->router->post('/adminFriendRequests', [AdminController::class, 'adminFriendRequests']);

$app->router->get('/adminNotifs', [AdminController::class, 'getAdminNotifs']);
$app->router->post('/adminNotifs', [AdminController::class, 'adminNotifs']);

$app->router->get('/notAdmin','notAdmin');

$app->router->matchRoute($_SERVER['REQUEST_URI']);