<?php

namespace Drupal\drush_command;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Component\Plugin\Discovery\CachedDiscoveryInterface;

/**
 * Interface DrushCommandPluginManagerInterface.
 *
 * @package Drupal\drush_command
 */
interface DrushCommandPluginManagerInterface extends PluginManagerInterface, CachedDiscoveryInterface {

  /**
   * Returns an array of DrushCommand plugin instances.
   *
   * @see hook_drush_command()
   */
  public function getDrushCommands();

}
