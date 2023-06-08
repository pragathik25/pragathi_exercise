<?php

namespace Drupal\pragathi_exercise\Plugin\Block;

// Using this as base class for the block.
use Drupal\Core\Block\BlockBase;

/**
 * Provides a simple block for custom form.
 *
 * @Block(
 * id="custom_form_example",
 * admin_label="custom form block",
 * )
 */
class CustomRender extends BlockBase {

  /**
   * {@inheritDoc}
   */
  public function build() {
    // This service will return customform in the block.
    $form = \Drupal::formBuilder()->getForm('Drupal\pragathi_exercise\Form\CustomDemo');
    return $form;
  }

}
