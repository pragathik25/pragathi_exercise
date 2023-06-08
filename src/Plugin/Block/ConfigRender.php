<?php

namespace Drupal\pragathi_exercise\Plugin\Block;

// Using this as base class for the block.
use Drupal\Core\Block\BlockBase;

/**
 * Provides a simple block for custom form.
 *
 * @Block(
 * id="config_form_example",
 * admin_label="config form block",
 * )
 */
class ConfigRender extends BlockBase {
  // Extending the base class.

  /**
   * {@inheritDoc}
   */
  public function build() {
    // This service will return config form in the block.
    $form = \Drupal::formBuilder()->getForm('Drupal\pragathi_exercise\Form\ConfigDemo');
    return $form;
  }

}
