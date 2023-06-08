<?php

namespace Drupal\pragathi_exercise\Controller;

// Base class for controllerdemo.
use Drupal\Core\Controller\ControllerBase;

/**
 * To include custom_service.
 */
class ControllerDemo extends ControllerBase {
  // Extending the base class.

  /**
   * Class declaration.
   */
  public function demo() {
    // Defining a function demo()
    // Calling the service.
    $data = \Drupal::service('custom_service')->getName();
    return [
    // Rendering the template.
      '#theme' => 'controller_template',
    // Service value is passed.
      '#message' => $data,
    // Setting the hexcode color.
      '#hexcode' => '#FF0000',
    ];
  }

}
