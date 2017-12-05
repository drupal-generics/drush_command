<?php

namespace Drupal\drush_command;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for DrushCommand plugins.
 */
interface DrushCommandPluginInspectionInterface extends PluginInspectionInterface {

  /**
   * Return the name of the step.
   *
   * @return string
   *   The name of the validator.
   */
  public function getName();

  /**
   * Returns the description of the drush command.
   *
   * @return string
   *   The description.
   */
  public function getDescription();

  /**
   * Returns an array of options.
   *
   * @return array
   *   The options.
   */
  public function getOptions();

  /**
   * Returns one option from the options array.
   *
   * @param string $key
   *   The key of the option.
   *
   * @return string
   *   The value of the option.
   */
  public function getOption(string $key);

  /**
   * Performs step specific validations.
   */
  public function execute();

}
