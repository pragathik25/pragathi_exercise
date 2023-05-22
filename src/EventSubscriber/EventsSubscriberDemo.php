<?php

namespace Drupal\pragathi_exercise\EventSubscriber; //namespace for EventSubscriber

use Symfony\Component\EventDispatcher\EventSubscriberInterface; //used as baseclass for EventSubcriberDemo
use Drupal\Core\Config\ConfigEvents; //defines event for the configuration system
use Drupal\Core\Config\ConfigCrudEvent;

class EventsSubscriberDemo implements EventSubscriberInterface { //extending the baseclass
    /**
   * {@inheritdoc}
   *
   * @return array
   */
  public static function getSubscribedEvents() { //this function is mandatory for eventsubcriber
    $events[ConfigEvents::SAVE][] = ['configSave', -100]; //returns the configuration when it saved
    $events[ConfigEvents::DELETE][] = ['configDelete', 100]; //returns the configuration when it is deleted
    return $events;
    }

    public function configSave(ConfigCrudEvent $event) { //funtion for configSave
        $config = $event->getConfig(); //return the Config Object
        \Drupal::messenger()->addStatus('Saved config: ' . $config->getName()); //messenger service is called
      }

      public function configDelete(ConfigCrudEvent $event) { //function for configDelete
        $config = $event->getConfig(); //return the Config Object
        \Drupal::messenger()->addStatus('Deleted config: ' . $config->getName()); //messenger service is called
      }

}