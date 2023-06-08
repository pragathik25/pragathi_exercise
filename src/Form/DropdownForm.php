<?php

namespace Drupal\pragathi_exercise\Form;

// Used as base class.
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Used for form.
 */
class DropdownForm extends FormBase {
  // Extending the base class.

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    // Will return the id.
    return 'dependent_dropdown_Form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Creating a dropdown.
    // Return list of country.
    $opt = static::countryCategory();
    // Default value set to none.
    $country = $form_state->getValue('country') ?: 'none';
    // Default value set to none.
    $state = $form_state->getValue('state') ?: 'none';

    // Creating a form for country.
    $form['country'] = [
    // Is of type select.
      '#type' => 'select',
    // Title.
      '#title' => 'CHOOSE COUNTRY',
    // Will give the list of country.
      '#options' => $opt,
    // Set to none.
      'default_value' => $country,
      '#ajax' => [
    // Function defined for ajax.
        'callback' => '::dropdownCallback',
    // Specifies id that will be updated with ajax response.
        'wrapper' => 'field-container',
    // Since it of type select.
        'event' => 'change',
      ],
    ];
    // Creating a form for state.
    $form['state'] = [
    // Is of type select.
      '#type' => 'select',
    // Title.
      '#title' => 'CHOOSE STATE',
    // Will return list of state.
      '#options' => static::state($country),
    // Fetching the value.
      '#default_value' => !empty($form_state->getValue('state')) ? $form_state->getValue('state') : '',
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
      '#ajax' => [
    // Function defined for ajax.
        'callback' => '::dropdownCallback',
    // Specifies id that will be updated with ajax response.
        'wrapper' => 'dist-container',
    // Since it of type select.
        'event' => 'change',
      ],
    ];
    // Creating a form for state.
    $form['district'] = [
    // Is of type select.
      '#type' => 'select',
    // Title.
      '#title' => 'CHOOSE DISTRICT',
    // Will return list of district.
      '#options' => static::district($state),
    // Will return list of state.
      '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',
      '#prefix' => '<div id="dist-container"',
      '#suffix' => '</div>',
    ];
    // Submitting the form.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Submit form.
    // Value will be stored.
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger != 'submit') {
      // If value is not submitted it will be triggered.
      $form_state->setRebuild();
    }
  }

  /**
   * Function.
   */
  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    // This has a ajax callback which will be.
    // Triggered when value of dropdown changes.
    // Getting the getTriggeringElement.
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'country') {
      // Lists the state for the particular country.
      return $form['state'];
    }
    elseif ($triggering_element_name === 'state') {
      // Lists the state for the particular country.
      return $form['district'];
    }

  }

  /**
   * Function.
   */
  public function countryCategory() {
    // Creating a dropdown options.
    return [
      'none' => '-none-',
      'INDIA' => 'INDIA',
      'CHINA' => 'CHINA',
      'CANADA' => 'CANADA',
    ];
  }

  /**
   * Function.
   */
  public function state($country) {
    // Creating a dropdown options.
    switch ($country) {
      case 'INDIA':
        $opt = [
          'KARNATAKA' => 'KARNATAKA',
          'KERALA' => 'KERALA',
          'MAHARASTRA' => 'MAHARASTRA',
        ];
        break;

      case 'CHINA':
        $opt = [
          'HUNAN' => 'HUNAN',
          'HEBEI' => 'HEBEI',
          'ZHEJIANG' => 'ZHEJIANG',
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

  /**
   * Function.
   */
  public function district($state) {
    // Creating a dropdown options.
    switch ($state) {
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
          'TRISSUR' => 'TRISSUR',
        ];
        break;

      case 'MAHARASTRA':
        $opt = [
          'MUMBAI' => 'MUMBAI',
          'NASHIK' => 'NASHIK',
          'PUNE' => 'PUNE',
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
          'HEXI' => 'HEXI',
        ];
        break;

      case 'ZHEJIANG':
        $opt = [
          'BINJIANG' => 'BINJIANG',
          'YUHANG' => 'YUHANG',
          'LINAN' => 'LINAN',
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
          'TORONTO' => 'TORONTO',
        ];
        break;

      case 'QUEBEC':
        $opt = [
          'ABITIBI' => 'ABITIBI',
          'ALMA' => 'ALMA',
          'BEAUCE' => 'BEAUCE',
        ];
        break;

      default:
        $opt = ['none' => '-none-'];
        break;
    }
    return $opt;
  }

}
