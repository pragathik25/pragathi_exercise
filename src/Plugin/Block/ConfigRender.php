<?php

namespace Drupal\pragathi_exercise\Plugin\Block; //namespace for block

use Drupal\Core\Block\BlockBase; //using this as base class for the block


/**
 * Provides a simple block for custom form
 * @Block(
 * id="config_form_example",
 * admin_label="config form block",
 * )
 */

class ConfigRender extends BlockBase { //extending the base class
    /**
     * @inheritDoc
     */

    public function build(){
        $form= \Drupal::formBuilder()->getForm('Drupal\pragathi_exercise\Form\ConfigDemo'); //this service will return config form in the block
        return $form;
        }
    }
