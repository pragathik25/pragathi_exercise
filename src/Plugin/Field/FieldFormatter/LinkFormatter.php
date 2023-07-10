<?php

namespace Drupal\pragathi_exercise\Plugin\Field\FieldFormatter;


use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;

/**
 * Define the "custom field link formatter".
 *
 * @FieldFormatter(
 *   id = "link_formatter",
 *   label = @Translation("Link Formatter"),
 *   description = @Translation("Desc for Link Formatter"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */

class LinkFormatter extends EntityReferenceFormatterBase {

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($this->getEntitiesToView($items, $langcode) as $delta => $entity) {
            $title = $entity->label();
            $url = $entity->toUrl()->setAbsolute();

        $elements[$delta] = [
            '#type' => 'markup',
            '#markup' => $this->t('@title | <a href="@url">@url</a>', [
                '@title' => $title,
                '@url' => $url->toString(),
                ]),
            ];
        }

        return $elements;
    }
}