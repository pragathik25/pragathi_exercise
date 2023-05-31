<?php

namespace Drupal\pragathi_exercise\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drush\Commands\DrushCommands;
use Drupal\Core\Entity\EntityTypeManagerInterface;

class DrushCommandsDemo extends DrushCommands {

/**
   * Command that returns a list of all blocked users.
   *
   * @field-labels
   *  id: User Id
   *  name: User Name
   *  email: User Email
   * @default-fields id,name,email
   *
   * @usage drush-helpers:active-editor
   *   Returns all active-editor
   *
   * @command drush-helpers:active-editor
   * @aliases active-editor
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   */
public function blockedUsers() {

    $users = $this->entityManager->getStorage('user')->loadByProperties(['status' => 1]);
    $rows = [];
    foreach ($users as $user) {
        if ($user->hasRole('content_editor')) {
        $rows[] = [
            'id' => $user->id(),
            'name' => $user->name->value,
            'email' => $user->mail->value,
        ];
        }
    }
   // print_r($rows);exit;
    return new RowsOfFields($rows);
    }

}