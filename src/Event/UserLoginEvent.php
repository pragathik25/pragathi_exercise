<?php

namespace Drupal\pragathi_exercise\Event; //namespace for UserLoginEvent

use Drupal\Component\EventDispatcher\Event; //used as base class
use Drupal\user\UserInterface; //to get user details

/**
 * Event that is fired when a user logs in.
 */
class UserLoginEvent extends Event {  //extending the base class

  // This makes it easier for subscribers to reliably use our event name.
const EVENT_NAME = 'custom_events_user_login';

/**
   * The user account.
   *
   * @var \Drupal\user\UserInterface
   */
public $account;

/**
   * Constructs the object.
   *
   * @param \Drupal\user\UserInterface $account
   *   The account of the user logged in.
   */
public function __construct(UserInterface $account) {
    $this->account = $account;  //will return the user account
}

}