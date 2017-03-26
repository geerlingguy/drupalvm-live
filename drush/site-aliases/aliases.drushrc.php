<?php

/**
 * @file
 * Drush Aliases for Drupal VM Live.
 */

$aliases['local.drupalvm.com'] = array(
  'root' => '/var/www/drupal/web',
  'uri' => 'http://local.drupalvm.com',
  'remote-host' => 'local.drupalvm.com',
  'remote-user' => 'vagrant',
  'ssh-options' => '-o PasswordAuthentication=no -i ' . drush_server_home() . '/.vagrant.d/insecure_private_key'
);

$aliases['prod.drupalvm.com'] = array(
  'root' => '/var/www/drupal/web',
  'uri' => 'http://prod.drupalvm.com',
  'remote-host' => 'prod.drupalvm.com',
  'remote-user' => 'geerlingguy',
);
