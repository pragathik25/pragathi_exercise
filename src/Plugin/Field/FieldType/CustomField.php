<?php

namespace Drupal\pragathi_exercise\Plugin\Field\FieldType; //namespace for FieldType

use Drupal\Core\Field\FieldItemBase; //used as baseclass
use Drupal\Core\Field\FieldStorageDefinitionInterface; //interface is used for storage
use Drupal\Core\Form\FormStateInterface; //interface is used for form
use Drupal\Core\TypedData\DataDefinition; //provides the defintion for primitive data types

/**
 * Define the "custom field type".
 *
 * @FieldType(
 *   id = "custom_field_type",
 *   label = @Translation("Custom Field Type"),
 *   description = @Translation("Desc for Custom Field Type"),
 *   category = @Translation("Text"),
 *   default_widget = "custom_field_widget",
 *   default_formatter = "custom_field_formatter",
 * )
 */

class CustomField extends FieldItemBase { //extending base class

    /**
     * {@inheritdoc}
     */

    public static function schema(FieldStorageDefinitionInterface $field_definition) { //creating a table in db
        return [
            'columns' => [
                'value' => [
                    'type' => 'varchar',
                    'length' => $field_definition->getSetting("length"),
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function defaultStorageSettings() {
        return [
            'length' => 255,
        ] + parent::defaultStorageSettings(); //default value for length is s set to 255
    }

    /**
     * {@inheritdoc}
     */
    public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) { //function for storagesetting that appears when we add a field
        $element = [];

        $element['length'] = [ //length for the field
            '#type' => 'number',
            '#title' => t("Length of your text"), //title
            '#required' => TRUE, //mandatory to be filled
            '#default_value' => $this->getSetting("length"), //will return the length value
        ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public static function defaultFieldSettings() {  //function to define a default field
        return [
            'moreinfo' => "More info default value", //default value is set
        ] + parent::defaultFieldSettings(); //this return the default field setting
    }

    /**
     * {@inheritdoc}
     */
    public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
        $element = [];
        $element['moreinfo'] = [
            '#type' => 'textfield', //moreinfo of type textfield
            '#title' => 'More information about this field',
            '#required' => TRUE,
            '#default_value' => $this->getSetting("moreinfo"), //will retuen default value of moreinfo
        ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public static function PropertyDefinitions(FieldStorageDefinitionInterface $field_definition) { //function to define field item properties
        $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

        return $properties;
    }
}