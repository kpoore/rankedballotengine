<?php

error_reporting(E_ERROR | E_PARSE);

session_start();
date_default_timezone_set("Canada/Eastern");

require '../vendor/autoload.php';
require '../lib/config.php';

Epi::init('api');
Epi::init('route','session-php');
Epi::init('database');
Epi::setSetting('exceptions', true);

getRoute()->get('/', 'home');
getRoute()->get('.*', 'error404');
getRoute()->run();

function rbeinit() {
  EpiDatabase::employ(RBEConfig::DB_TYPE, RBEConfig::DB_NAME, RBEConfig::DB_HOST, RBEConfig::DB_USER, RBEConfig::DB_PASS);
}

function home() {
  top();
  ?>
  Welcome home!
  <?php
  bottom();
}

function error404() {
  ?>
  Page not found.
  <?php
}

function top($title = '') {
  rbeinit();
  ?>
  <html>
  <head>
  <title><?php print $title; ?></title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css"/>
  <link rel="stylesheet" href="/style.css"/>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="jumbotron"><?php print $title; ?></div>
  <div id="content">
  <?php
}

function bottom() {
  ?>
  </div><!-- #content -->
  </body>
  </html>
  <?php
}

