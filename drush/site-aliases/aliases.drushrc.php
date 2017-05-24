<?php

/**
 * @file
 * Drush Aliases for Drupal VM Live.
 */

// Local environment.
$aliases['local.drupalvm.com'] = array(
  'root' => '/var/www/drupalvm/drupal/web',
  'uri' => 'http://local.drupalvm.com',
  );
// Add remote connection options when alias is used outside VM.
// Uncomment when using Vagrant instead of Docker.
// if ('vagrant' != $_SERVER['USER']) {
//   $aliases['local.drupalvm.com'] += array(
//     'remote-host' => 'local.drupalvm.com',
//     'remote-user' => 'vagrant',
//     'ssh-options' => '-o PasswordAuthentication=no -i ' . drush_server_home() . '/.vagrant.d/insecure_private_key'
//   );
// }

$aliases['prod.drupalvm.com'] = array(
  'root' => '/var/www/drupal/web',
  'uri' => 'http://prod.drupalvm.com',
  'remote-host' => 'prod.drupalvm.com',
  'remote-user' => 'geerlingguy',
);
