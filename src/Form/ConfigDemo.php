<?php

namespace Drupal\pragathi_exercise\Form; //namespace for configform

use Drupal\Core\Form\ConfigFormBase; //to include it as base class for config form
use Drupal\Core\Form\FormStateInterface; //to include the form

class ConfigDemo extends ConfigFormBase { //extending ConfigFormBase as base class for configdemo

    Const RESULT = "pragathi_exercise.settings"; //where the value is stored
    public function getFormId() { //this will return unique form id
        return "pragathi_exercise_settings";
    }

    protected function getEditableConfigNames() { //will return the values
        return [
            static::RESULT, //where the values are stored
        ];
}

    public function buildForm(array $form, FormStateInterface $form_state) { //to create a form
        $config = $this->config(static::RESULT); //where the value should be configured
        $form['NAME'] = [
            '#type' => 'textfield',
            '#title' => '<span>NAME</span>',
            '#attached'=>[ //attaching css file for this field
                'library'=>[
                    'pragathi_exercise/config_lib',
                ],
            ],
            '#default_value' => $config->get("NAME"), //returns value given for name
        ];

        $form['PLACE'] = [
            '#type' => 'textfield',
            '#title' => 'PLACE',
            '#default_value' => $config->get("PLACE"),
        ];
        $form['gender'] = [
            '#type' => 'select',
            '#title' => 'Gender',
            '#options' => [
                'male' => 'Male',
                'female' => 'Female',
            ],
        ];

        return Parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config(static::RESULT);
        $config->set("NAME", $form_state->getValue('NAME')); //will set the value for name field which we have submitted
        $config->set("PLACE", $form_state->getValue('PLACE'));
        $config->set("GENDER", $form_state->getValue('GENDER'));
        $config->save();
    }

}