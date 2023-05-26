<?php

namespace Drupal\pragathi_exercise\EventSubscriber; //namespace for UserLoginDemo
use Drupal\pragathi_exercise\Event\UserLoginEvent; //to use the custom Event created
use Symfony\Component\EventDispatcher\EventSubscriberInterface; //used as base class

/**
 * Class UserLoginSubscriber.
 *
 * @package Drupal\pragathi_exercise\EventSubscriber
 */
class UserLoginDemo implements EventSubscriberInterface { //extending the base class

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() { //calling the getSubscribedEvents function
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
    $database = \Drupal::database(); //using the service of database
    $dateFormatter = \Drupal::service('date.formatter'); //using the service to get date.formatter

    $account_created = $database->select('users_field_data', 'ud') //selecting the table from db
      ->fields('ud', ['created'])  //returns when the account was created
      ->condition('ud.uid', $event->account->id())  //returns the userid
      ->execute()
      ->fetchField();
    //using message service to get message whenever user logs in
    \Drupal::messenger()->addStatus(t('Welcome to the site, your account was created on %created_date.', [
      '%created_date' => $dateFormatter->format($account_created, 'long'),
    ]));
  }

}