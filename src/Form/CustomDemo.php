<?php

namespace Drupal\pragathi_exercise\Form; //namespace for customdemo

use Drupal\Core\Form\FormBase; //to use as base class for customform
use Drupal\Core\Form\FormStateInterface; //used for form

class CustomDemo extends FormBase {

    // generated form id
    public function getFormId()
    {
        return 'custom_demo_get_user_details';
    }

    // build form generates form
    public function buildForm(array $form, FormStateInterface $form_state) { //creating a form with fields
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


    // submit form
    public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::messenger()->addMessage("thank you for submitting the details"); //using a service to add message after submitting
        \Drupal::database()->insert("custom_demo")->fields([ //using a service of database to store datas submitted
            'name' => $form_state->getValue("name"),
            'usn' => $form_state->getValue("usn"),
            'email' => $form_state->getValue("email"),
            'place' => $form_state->getValue("place"),
        ])->execute();
    }
}


