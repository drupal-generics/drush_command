<?php

namespace Drupal\drush_command;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * DrushCommand plugin manager.
 */
class DrushCommandPluginManager extends DefaultPluginManager implements DrushCommandPluginManagerInterface {

  /**
   * Constructs an DrushCommandPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/DrushCommand', $namespaces, $module_handler, 'Drupal\drush_command\DrushCommandPluginInspectionInterface', 'Drupal\drush_command\Annotation\DrushCommand');
    $this->alterInfo('drush_command_info');
    $this->setCacheBackend($cache_backend, 'drush_command');
  }

  /**
   * {@inheritdoc}
   */
  public function getDrushCommands() {
    $instances = [];
    $commands = $this->getDefinitions();
    foreach ($commands as $key => $command) {
      $instances[$command['command']] = $this->createDrushCommandDefinition($command);
    }

    return $instances;
  }

  /**
   * Created a drush command.
   *
   * @param array $command
   *   Drush command definition.
   *
   * @return array
   *   The drush command array.
   */
  private function createDrushCommandDefinition(array $command) {
    /** @var \Drupal\drush_command\DrushCommandPluginBase $instance */
    $instance = $this->createInstance($command['id']);

    $options = $instance->getOptions();
    $definition = [
      'callback' => [$instance, 'execute'],
      'description' => $instance->getDescription(),
      'options' => $options ? $options : [],
    ];

    return $definition;
  }

}
