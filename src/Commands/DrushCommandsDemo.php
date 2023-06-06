<?php

namespace Drupal\pragathi_exercise\Commands;  //namespace

use Consolidation\OutputFormatters\StructuredData\RowsOfFields; //to format the output usingRowsOfFields
use Drush\Commands\DrushCommands; //used as base class
use Drupal\Core\Entity\EntityTypeManagerInterface; //to use the service

class DrushCommandsDemo extends DrushCommands {  //extending the base class
  /**
   * @var Drupal\Core\Entity\EntityTypeManagerInterface $entityManager
   *    Entity manager service.
   */

   public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityManager = $entityTypeManager;  //to load the entity
    parent::__construct();
  }
/**
   * Command that returns a list of all blocked users.
   *
   * @field-labels
   *  id: Node Id
   *  title: Title
   * @default-fields id,title
   *
   * @usage drush-helpers: get-title
   *   Returns all get-title
   *
   * @command drush-helpers:get-title
   * @aliases get-title
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   */
  public function drushDemo() {
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'page']); //it will load nodes of type basic page
    $rows = [];
    foreach($nodes as $node) {
        $rows[] = [
          'id' => $node->id(), //returns node id
          'title' => $node->getTitle(), //returns the title
        ];
  }
        return new RowsOfFields($rows); //output will be displayed in rows
    }
  }

