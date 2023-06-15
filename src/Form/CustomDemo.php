<?php

namespace Drupal\pragathi_exercise\Form;

// Namespace for customdemo.
use Drupal\Core\Form\FormBase;
// To use as base class for customform.
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Used for form.
 */
class CustomDemo extends FormBase {
  /**
   * The Messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;
  /**
   * The Messenger service.
   *
   * @var Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs InviteByEmail .
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\Core\Database\Connection $database
   *   The database service.
   */
  public function __construct(MessengerInterface $messenger, Connection $database) {
    $this->messenger = $messenger;
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger'),
      $container->get('database'),
    );
  }

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
    $this->messenger->addStatus("thank you for submitting the form");
    // Using a service of database to store datas submitted.
    $this->database->insert("custom_demo")->fields([
      'name' => $form_state->getValue("name"),
      'usn' => $form_state->getValue("usn"),
      'email' => $form_state->getValue("email"),
      'place' => $form_state->getValue("place"),
    ])->execute();
  }

}
