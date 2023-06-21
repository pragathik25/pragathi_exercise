<?php

namespace Drupal\pragathi_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Function.
 */
class CustomController extends ControllerBase {

  /**
   * Function.
   */
  public function modalLink() {
    $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $build = [
      '#markup' => '<a href="/drupal-10.0.3/custom-demo" class="use-ajax" data-dialog-type="modal">Click here</a>',
    ];
    return $build;
  }

}
