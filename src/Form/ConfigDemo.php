<?php

namespace Drupal\pragathi_exercise\Form;

use Drupal\Core\Form\ConfigFormBase;
// To include it as base class for config form.
// To include the form.
use Drupal\Core\Form\FormStateInterface;

/**
 * Function.
 */
class ConfigDemo extends ConfigFormBase {
  // Extending ConfigFormBase as base class for configdemo.
  // Where the value is stored.
  const RESULT = "pragathi_exercise.settings";

  /**
   * Function.
   */
  public function getFormId() {
    // This will return unique form id.
    return "pragathi_exercise_settings";
  }

  /**
   * Function.
   */
  protected function getEditableConfigNames() {
    // Will return the values.
    return [
    // Where the values are stored.
      static::RESULT,
    ];
  }

  /**
   * Function.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // To create a form.
    // Where the value should be configured.
    $config = $this->config(static::RESULT);
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => '<span>name</span>',
    // Attaching css file for this field.
      '#attached' => [
        'library' => [
          'pragathi_exercise/config_lib',
        ],
      ],
      // Returns value given for name.
      '#default_value' => $config->get("name"),
    ];

    $form['place'] = [
      '#type' => 'textfield',
      '#title' => 'place',
      '#default_value' => $config->get("place"),
    ];
    $form['gender'] = [
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => [
        'male' => 'Male',
        'female' => 'Female',
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Function.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::RESULT);
    // Will set the value for name field which we have submitted.
    $config->set("name", $form_state->getValue('name'));
    $config->set("place", $form_state->getValue('place'));
    $config->set("gender", $form_state->getValue('gender'));
    $config->save();
  }

}
