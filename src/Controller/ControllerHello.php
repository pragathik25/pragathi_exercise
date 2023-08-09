<?php

namespace Drupal\pragathi_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;


/**
 * Undocumented class.
 */
class ControllerHello extends ControllerBase {

  /**
   *Function.
   */
  public function nodeLoad() {
    $nid = 29;
    $node = Node::load($nid);
    if ($node && $node->getType() === 'shapesss') {
      $shape = $node->getTitle();
      $color = $node->get('field_colorsss')->entity->getName();
      $user = $node->get('field_colorsss')->entity;
      $username = $user->get('field_user_reference')->entity->getDisplayName();
      $build = [
        '#markup' => " $shape $color $username",
      ];
      return $build;
    }
  }

}


// namespace Drupal\pragathi_exercise\Controller;

// use Drupal\Core\Controller\ControllerBase;
// use Drupal\Core\Entity\EntityTypeManagerInterface;
// use Symfony\Component\DependencyInjection\ContainerInterface;


// class ControllerHello extends ControllerBase {

//   protected $entityTypeManager;

//   public function __construct(EntityTypeManagerInterface $entityTypeManager) {
//     $this->entityTypeManager = $entityTypeManager;
//   }

//   public static function create(ContainerInterface $container) {
//     return new static(
//       $container->get('entity_type.manager')
//     );
//   }

//   public function nodeLoad() {
//     $nid = 29;
//     $node = $this->entityTypeManager->getStorage('node')->load($nid);
//     if ($node && $node->getType() === 'shapesss') {
//       $shape = $node->getTitle();
//       $color_tid = $node->get('field_colorsss')->target_id;

//       $color_term = $this->entityTypeManager->getStorage('taxonomy_term')->load($color_tid);
//       $color = $color_term->getName();

//       $user_reference = $color_term->get('field_user_reference')->target_id;
//       $user = $this->entityTypeManager->getStorage('user')->load($user_reference);
//       $username = $user->getDisplayName();

//       $build = [
//         '#markup' => "$shape $color $username",
//       ];

//       return $build;
//     }

// }
// }
