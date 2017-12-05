<?php

/**
 * @file
 * Drush integration for the mercedes_benelux_seo module.
 */

/**
 * Implements hook_drush_command().
 */
function drush_command_drush_command() {
  $items = [];
  try {
    /** @var \Drupal\drush_command\DrushCommandPluginManager $pluginManager */
    $pluginManager = \Drupal::service('plugin.manager.drush_command.command');

    $items = $pluginManager->getDrushCommands();
    define('DRUSH_COMMAND_CURRENT_DIR', drupal_get_path('module', 'drush_command'));
  }
  catch (\Exception $exception) {

  }

  return $items;
}

/**
 * Implements hook_drush_command_alter().
 */
function drush_command_drush_command_alter(&$command) {
  if ($command['path'] == DRUSH_COMMAND_CURRENT_DIR . '/drush') {
    $command['callback'] = $command['primary function'];
    $command['bootstrap'] = 5;
  }
}
