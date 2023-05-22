<?php

namespace Drupal\pragathi_exercise\Plugin\Field\FieldWidget; //namespace for FieldWidget

use Drupal\Core\Field\WidgetBase; //used as a baseclass
use Drupal\Core\Field\FieldItemListInterface; //interface for field
use Drupal\Core\Form\FormStateInterface; //interface for form

/**
 * Define the "custom field type".
 *
 * @FieldWidget(
 *   id = "custom_field_widget",
 *   label = @Translation("Custom Field Widget"),
 *   description = @Translation("Desc for Custom Field Widget"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */

class CustomWidget extends WidgetBase {  //extending baseclass

    /**
     * {@inheritdoc}
     */

     public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        $value = isset($items[$delta]->value) ? $items[$delta]->value : "";
        $element = $element + [
            '#type' => 'textfield',
            '#suffix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>", //used as suffix that appears on node edit page
            '#default_value' => $value,
            '#attributes' => [
                'placeholder' => $this->getSetting('placeholder'), //will return placeholder value
            ],
        ];
        return ['value' => $element];
     }

     /**
      * {@inheritdoc}
      */
      public static function defaultSettings() {
        return [
            'placeholder' => 'default',
        ] + parent::defaultSettings(); //will return default value of placeholder
      }

      /**
       * {@inheritdoc}
       */
      public function settingsForm(array $form, FormStateInterface $form_state) {
        $element['placeholder'] = [
            '#type' => 'textfield',
            '#title' => 'Placeholder text',
            '#default_value' => $this->getSetting('placeholder'), //will give placeholder value
        ];
        return $element;
      }

      /**
       * {@inheritdoc}
       */
      public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("placeholder text: @placeholder", array("@placeholder" => $this->getSetting("placeholder")));
        return $summary;
      }


}