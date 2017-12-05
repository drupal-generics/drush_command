<?php

namespace Drupal\drush_command;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class DrushCommandPluginBase.
 *
 * Provides common functionality for DrushCommand plugins.
 *
 * @package Drupal\drush_command
 */
abstract class DrushCommandPluginBase extends PluginBase implements DrushCommandPluginInspectionInterface {
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->pluginDefinition['name'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions() {
    return $this->pluginDefinition['options'];
  }

  /**
   * {@inheritdoc}
   */
  public function getOption(string $key) {
    if (isset($this->pluginDefinition['options']) && isset($this->pluginDefinition['options'][$key])) {
      return drush_get_option($key);
    }
    return '';
  }

}
