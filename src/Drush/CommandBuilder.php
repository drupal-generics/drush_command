<?php

namespace Drupal\drush_command\Drush;

use Drupal\Core\Site\Settings;

/**
 * Class CommandBuilder.
 *
 * @package Drupal\drush_command\Drush
 */
class CommandBuilder {

  /**
   * The working direcetory of drupal.
   *
   * @var string
   */
  private $projectPath;

  /**
   * Path to drush.
   *
   * @var string
   */
  private $drushPath;

  /**
   * The drush command.
   *
   * @var string
   */
  private $command;

  /**
   * The arguments to the drush command.
   *
   * @var array
   */
  private $arguments;

  /**
   * The options of the drush command.
   *
   * @var array
   */
  private $options;

  /**
   * The final command that will be executed.
   *
   * @var string
   */
  private $builtCommand = '';

  /**
   * CommandBuilder constructor.
   */
  public function __construct() {
    $this->projectPath = getcwd();
    $localSettings = Settings::get('drup_drush');
    $this->drushPath = $localSettings ?? $this->projectPath . '/../vendor/drush/drush/drush';
  }

  /**
   * Sets drush command.
   *
   * @param string $command
   *   Drush command.
   *
   * @return $this
   *   This command builder instance.
   */
  public function withCommand($command) {
    $this->command = $command;

    return $this;
  }

  /**
   * Sets drush command arguments.
   *
   * @param array $arguments
   *   Drush command arguments.
   *
   * @return $this
   *   This command builder instance.
   */
  public function withArguments(array $arguments) {
    $this->arguments = $arguments;

    return $this;
  }

  /**
   * Sets drush command options.
   *
   * @param array $options
   *   Drush command options.
   *
   * @return $this
   *   This command builder instance.
   */
  public function withOptions(array $options) {
    $this->options = $options;

    return $this;
  }

  /**
   * Builds a drush command string.
   *
   * @return \Drupal\drush_command\Drush\CommandBuilder
   *   Drush command string.
   */
  public function build() {
    $arguments = '';
    $options = '';
    $path = $this->drushPath;
    $command = $this->command;
    $projectPath = $this->projectPath;
    if ($this->arguments) {
      foreach ($this->arguments as $argument) {
        $arguments .= "$argument ";
      }
    }
    if ($this->options) {
      foreach ($this->options as $key => $option) {
        $options .= "--$key=$option ";
      }
    }

    $this->builtCommand = "cd $projectPath; $path $command $arguments $options> /dev/null &";

    return $this;
  }

  /**
   * Executes the command.
   */
  public function execute() {
    if (!empty($this->builtCommand)) {
      exec($this->builtCommand);
    }
  }

}
