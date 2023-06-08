<?php

namespace Drupal\pragathi_exercise\EventSubscriber;

// To use the custom Event created.
use Drupal\pragathi_exercise\Event\UserLoginEvent;
// Used as base class.
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserLoginSubscriber.
 *
 * @package Drupal\pragathi_exercise\EventSubscriber
 */
class UserLoginDemo implements EventSubscriberInterface {
  // Extending the base class.

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // Calling the getSubscribedEvents function.
    return [
      // Static class constant => method on this class.
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\pragathi_exercise\Event\UserLoginEvent $event
   *   Our custom general object.
   */
  public function onUserLogin(UserLoginEvent $event) {
    // Using the service of database.
    $database = \Drupal::database();
    // Using the service to get date.formatter.
    $dateFormatter = \Drupal::service('date.formatter');

    // Selecting the table from db.
    $account_created = $database->select('users_field_data', 'ud')
    // Returns when the account was created.
      ->fields('ud', ['created'])
    // Returns the userid.
      ->condition('ud.uid', $event->account->id())
      ->execute()
      ->fetchField();
    // Using message service to get message whenever user logs in.
    \Drupal::messenger()->addStatus(t('Welcome to the site, your account was created on %created_date.', [
      '%created_date' => $dateFormatter->format($account_created, 'long'),
    ]));
  }

}
