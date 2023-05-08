<?php
namespace Drupal\pragathi_exercise\Controller; //namepsace for controllerdemo can be used in otherfile

use Drupal\Core\Controller\ControllerBase; //base class for controllerdemo
use Drupal\pragathi_exercise\CustomService; //to include custom_service

class ControllerDemo extends ControllerBase{ //extending the base class

    public function demo() { //defining a function demo()

       $data = \Drupal::service('custom_service')->getName(); //calling the service
        return [
            '#theme'=>'controller_template', //rendering the template
            '#message'=>$data, //service value is passed
            '#hexcode'=>'#FF0000', //setting the hexcode color
        ];
    }
}


