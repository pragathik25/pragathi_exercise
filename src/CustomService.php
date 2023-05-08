<?php

namespace Drupal\pragathi_exercise; //namespace for customservice

use Drupal\Core\Config\ConfigFactory; //including the configfactory service

/**
 * Class CustomService.
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
  public function __construct(ConfigFactory $configFactory) {  //assigning the variable
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   */
  public function getName() {
    $config = $this->configFactory->get('pragathi_exercise.settings'); //to get the values submiiting in config form
    return $config->get('NAME'); //will return the name value submitted in configform
  }

}