<?php

namespace Drupal\pragathi_exercise;

// Including the configfactory service.
use Drupal\Core\Config\ConfigFactory;

/**
 * Class Description.
 *
 * @package Drupal\pragathi_exercise\Services
 */
class CustomService {

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    // Assigning the variable.
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   */
  public function getName() {
    // To get the values submiiting in config form.
    $config = $this->configFactory->get('pragathi_exercise.settings');
    // Will return the name value submitted in configform.
    return $config->get('NAME');
  }

}
