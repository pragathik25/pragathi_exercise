<?php

namespace Drupal\pragathi_exercise\EventSubscriber;

// To use the custom Event created.
use Drupal\pragathi_exercise\Event\UserLoginEvent;
// Used as base class.
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Function.
 */
class UserLoginDemo implements EventSubscriberInterface {
  // Extending the base class.
  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * CustomConfigEventsSubscriber constructor.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   */
  public function __construct(Connection $database, MessengerInterface $messenger) {
    $this->database = $database;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      /* Static class constant => method on this class. */
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\pragathi_excercise\Event\UserLoginEvent $event
   *   Our custom event object.
   */
  public function onUserLogin(UserLoginEvent $event) {
    // Format timestamp into date time.
    $dateFormatter = \Drupal::service('date.formatter');

    // Fetch user data.
    $account_created = $this->database->select('users_field_data', 'ud')
      // Returns when the account was created.
      ->fields('ud', ['created'])
      // Returns user id.
      ->condition('ud.uid', $event->account->id())
      ->execute()
      ->fetchField();

    $this->messenger->addStatus(t('Welcome to the site, your account was created on %created_date.', ['%created_date' => $dateFormatter->format($account_created, 'short')]));
  }

}
