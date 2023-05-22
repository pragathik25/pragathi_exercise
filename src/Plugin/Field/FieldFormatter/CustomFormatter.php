<?php

namespace Drupal\pragathi_exercise\Plugin\Field\FieldFormatter; //namespace for FieldFormatter

use Drupal\Core\Field\FormatterBase; //used as baseclass
use Drupal\Core\Field\FieldItemListInterface;  //interface for field
use Drupal\Core\Form\FormStateInterface; //interface for form


/**
 * Define the "custom field formatter".
 *
 * @FieldFormatter(
 *   id = "custom_field_formatter",
 *   label = @Translation("Custom Field Formatter"),
 *   description = @Translation("Desc for Custom Field Formatter"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */


class CustomFormatter extends FormatterBase { //extending the baseclass

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
            'concat' => 'Concat with ',
        ] + parent::defaultSettings(); //will return the defaultSettings value
    }

    /**
     * {@inheritdoc}
     */

    public function settingsForm(array $form, FormStateInterface $form_state) { ////appears on setting of manage display
        $form['concat'] =[ //creating a form
            '#type' => 'textfield', //textfield type
            '#title' => 'Concatenate with', //title
            '#default_value' => $this->getSetting('concat'), //default value is set
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]); //will concatenate with @concat
        return $summary;
    }

    /**
     * {@inheritdoc}
     */

     public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];

        foreach ( $items as $delta => $item) {
//delta is for cardinality
            $element[$delta] = [
                 '#markup' => $this->getSetting('concat') . $item->value, //will return concat and value submited in the frontend
            ];
        }
        return $element;
     }

}
