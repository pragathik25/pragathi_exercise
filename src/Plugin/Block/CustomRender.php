<?php

namespace Drupal\pragathi_exercise\Plugin\Block; //namespace for block

use Drupal\Core\Block\BlockBase; //using this as base class for the block


/**
 * Provides a simple block for custom form
 * @Block(
 * id="custom_form_example",
 * admin_label="custom form block",
 * )
 */

class CustomRender extends BlockBase {
    /**
     * @inheritDoc
     */

    public function build(){
        $form = \Drupal::formBuilder()->getForm('Drupal\pragathi_exercise\Form\CustomDemo'); //this service will return customform in the block

        return $form;
    }
}