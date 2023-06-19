<?php

namespace Drupal\pragathi_exercise\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Session\AccountInterface;

/**
 * Function.
 */
class ControllerClone extends ControllerBase {

  /**
   * Function.
   */
  public function nodeTitle(Node $node) {
    if (!empty($node)) {
      $title = $node->getTitle();
      return [
        '#markup' => $title,
      ];
    }
    else {
      throw new NotFoundHttpException();
    }
  }

  /**
   * Function.
   */
  public function nodeTitlePageTitle(Node $node) {
    $prepend_text = "Node of ";
    return $prepend_text . $node->getTitle();
  }

  /**
   * Function.
   */
  public function accessNode(AccountInterface $account, $node) {
    $node = Node::load($node);
    $type = $node->getType();
    if ($type == 'article' || $type === 'page') {
      $result = AccessResult::allowed();
    }
    else {
      $result = AccessResult::forbidden();
    }

    $result->addCacheableDependency($node);

    return $result;
  }

}
