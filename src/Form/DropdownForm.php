<?php

namespace Drupal\pragathi_exercise\Form; //namespace for dropdown

use Drupal\Core\Form\FormBase; //used as base class
use Drupal\Core\Form\FormStateInterface; //used for form


class DropdownForm extends FormBase { //extending the base class

   /**
   * {@inheritdoc}
   */
  public function getFormId() { //will return the id
    return 'dependent_dropdown_Form';
  }

  /**
   * {@inheritdoc}
   */

public function buildForm(array $form, FormStateInterface $form_state) { //creating a dropdown
  $opt = static::countryCategory(); //return list of country
  $country = $form_state->getValue('country') ?: 'none'; //default value set to none
  $state = $form_state->getValue('state') ?: 'none'; //default value set to none

  $form['country'] = [ //creating a form for country
      '#type' => 'select', //is of type select
      '#title' => 'CHOOSE COUNTRY', //title
      '#options' => $opt, //will give the list of country
      'default_value' => $country, //set to none
      '#ajax' => [
          'callback' => '::DropdownCallback', //function defined for ajax
          'wrapper' => 'field-container', //specifies id that will be updated with ajax response
          'event' => 'change' //since it of type select
      ]
  ];
  $form['state'] = [ //creating a form for state
      '#type' => 'select',  //is of type select
      '#title' => 'CHOOSE STATE', //title
      '#options' =>static::state($country), //will return list of state
      '#default_value' => !empty($form_state->getValue('state')) ? $form_state->getValue('state') : '', //fetching the value
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
      '#ajax' => [
        'callback' => '::DropdownCallback',//function defined for ajax
        'wrapper' => 'dist-container',//specifies id that will be updated with ajax response
        'event' => 'change' //since it of type select
    ]
  ];
  $form['district'] = [//creating a form for state
    '#type' => 'select',//is of type select
    '#title' => 'CHOOSE DISTRICT',//title
    '#options' =>static::district($state), //will return list of district
    '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '', //will return list of state
    '#prefix' => '<div id="dist-container"',
    '#suffix' => '</div>',
];
  $form['submit'] = [ //submitting the form
      '#type' => 'submit',
      '#value' => 'Submit',
  ];
  return $form;
}

/**
 * {@inheritdoc}
 */
public function submitForm(array &$form, FormStateInterface $form_state) { //submit form
  $trigger = (string) $form_state->getTriggeringElement()['#value']; //value will be stored
  if ($trigger != 'submit') {
      $form_state->setRebuild(); //if value is not submitted it will be triggered
  }
}

public function DropdownCallback(array &$form, FormStateInterface $form_state) { //this has a ajax callback which will be triggered when value of dropdown changes
  $triggering_element = $form_state->getTriggeringElement(); //getting the getTriggeringElement
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'country') {
      return $form['state']; //lists the state for the particular country
    }
    elseif ($triggering_element_name === 'state') {
      return $form['district'];//lists the state for the particular country
    }

}

public function countryCategory() { //creating a dropdown options
  return [
      'none' => '-none-',
      'INDIA' => 'INDIA',
      'CHINA'=>'CHINA',
      'CANADA' => 'CANADA',
  ];
}

public function state($country) { //creating a dropdown options
  switch ($country) {
      case 'INDIA':
          $opt = [
              'KARNATAKA' => 'KARNATAKA',
              'KERALA' => 'KERALA',
              'MAHARASTRA'=>'MAHARASTRA',
          ];
      break;
      case 'CHINA':
        $opt = [
          'HUNAN'=>'HUNAN',
          'HEBEI'=>'HEBEI',
          'ZHEJIANG'=>'ZHEJIANG',
        ];
        break;
      case 'CANADA':
          $opt = [
              'ALBERTA' => 'ALBERTA',
              'ONTARIO' => 'ONTARIO',
              'QUEBEC' => 'QUEBEC',
          ];
      break;
      default:
        $opt = ['none' => '-none-'];
      break;
  }
  return $opt;
}
public function district($state) { //creating a dropdown options
  switch($state) {
    case 'KARNATAKA':
      $opt = [
        'BANGALORE' => 'BANGALORE',
        'UDUPI' => 'UDUPI',
        'DK' => 'DK',
      ];
    break;
    case 'KERALA':
      $opt = [
        'WAYANAD' => 'WAYANAD',
        'KOTTAYAM' => 'KOTTAYAM',
        'TRISSUR'=>'TRISSUR',
      ];
    break;
    case 'MAHARASTRA':
      $opt = [
        'MUMBAI' => 'MUMBAI',
        'NASHIK' => 'NASHIK',
        'PUNE'=>'PUNE',
      ];
    break;
    case 'HUNAN':
      $opt = [
        'FURONG' => 'FURONG',
        'YUELU' => 'YUELU',
        'KAIFU' => 'KAIFU',
      ];
    break;
    case 'HEBEI':
      $opt = [
        'HEPING' => 'HEPING',
        'HEDONG' => 'HEDONG',
        'HEXI'=>'HEXI',
      ];
    break;
    case 'ZHEJIANG':
      $opt = [
        'BINJIANG' => 'BINJIANG',
        'YUHANG' => 'YUHANG',
        'LINAN'=>'LINAN',
      ];
    break;
    case 'ALBERTA':
      $opt = [
        'ACADIA' => 'ACADIA',
        'BIGHORN' => 'BIGHORN',
        'CYPRESS' => 'CYPRESS',
      ];
    break;
    case 'ONTARIO':
      $opt = [
        'OTTAWA' => 'OTTAWA',
        'BRANT' => 'BRANT',
        'TORONTO'=>'TORONTO',
      ];
    break;
    case 'QUEBEC':
      $opt = [
        'ABITIBI' => 'ABITIBI',
        'ALMA' => 'ALMA',
        'BEAUCE'=>'BEAUCE',
      ];
    break;
    default:
        $opt = ['none' => '-none-'];
      break;
  }
  return $opt;
}

}