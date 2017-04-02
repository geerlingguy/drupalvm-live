<?php

/**
 * @file
 * Drush command for running behat tests.
 */

/**
 * Implements hook_drush_command().
 */
function behat_drush_command() {

  $items['behat'] = array(
    'description' => "Run behat tests.",
    // No bootstrap at all.
    'bootstrap' => DRUSH_BOOTSTRAP_NONE,
  );

  return $items;
}

/**
 * Implements drush_hook_COMMAND().
 */
function drush_behat() {
  drush_shell_exec_interactive('cd ' . dirname(DRUPAL_ROOT) . '/tests && ../vendor/bin/behat --colors --stop-on-failure');
}
