<?php

namespace Drupal\pragathi_exercise\Form;

// Namespace for customdemo.
use Drupal\Core\Form\FormBase;
// To use as base class for customform.
use Drupal\Core\Form\FormStateInterface;

/**
 * Used for form.
 */
class CustomDemo extends FormBase {

  /**
   * Undocumented function.
   *
   * @return void
   *   Description for form.
   */
  public function getFormId() {
    return 'custom_demo_get_user_details';
  }

  /**
   * Build form generates form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Creating a form with fields.
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => 'Name',
      '#required' => TRUE,
      '#placeholder' => 'name',
    ];
    $form['usn'] = [
      '#type' => 'textfield',
      '#title' => 'USN',
      '#required' => TRUE,
      '#placeholder' => '123',
    ];
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => 'Email',
      '#placeholder' => 'abc@gmail.com',

    ];
    $form['place'] = [
      '#type' => 'textfield',
      '#title' => 'place',
      '#required' => TRUE,
      '#placeholder' => 'place',
      '#default_value' => 'bangalore',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Save the configuration',
    ];
    return $form;
  }

  /**
   * Submit form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Using a service to add message after submitting.
    \Drupal::messenger()->addMessage("thank you for submitting the details");
    // Using a service of database to store datas submitted.
    \Drupal::database()->insert("custom_demo")->fields([
      'name' => $form_state->getValue("name"),
      'usn' => $form_state->getValue("usn"),
      'email' => $form_state->getValue("email"),
      'place' => $form_state->getValue("place"),
    ])->execute();
  }

}
