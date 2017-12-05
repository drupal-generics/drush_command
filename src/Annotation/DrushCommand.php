<?php

namespace Drupal\drush_command\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a step for multi-step forms.
 *
 * @see \Drupal\drush_command\DrushCommandPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class DrushCommand extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the validator.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $command;

  /**
   * Drush command description.
   *
   * @var string
   */
  public $description;

}
