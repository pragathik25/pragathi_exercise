<?php

namespace Drupal\pragathi_exercise;

// Including the configfactory service.
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class Description.
 */
class CustomService {

  /**
   * The config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructor for the ConfigHelper service.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Gets my setting.
   */
  public function getName() {
    // To get the values submiiting in config form.
    return $this->configFactory->getEditable('pragathi_exercise.settings')->get('name');
    // Will return the name value submitted in configform.
  }

}
