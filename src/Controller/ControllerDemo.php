<?php

namespace Drupal\pragathi_exercise\Controller;

// Base class for controllerdemo.
use Drupal\Core\Controller\ControllerBase;
use Drupal\pragathi_exercise\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * To include custom_service.
 */
class ControllerDemo extends ControllerBase {
  /**
   * The customservice.
   *
   * @var \Drupal\pragathi_exercise\CustomService
   */
  protected $customService;

  /**
   * Dependency injection.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('custom_service')
    );
  }

  /**
   * Constructor.
   */
  public function __construct(CustomService $customService) {
    $this->customService = $customService;
  }

  /**
   * Function demo.
   */
  public function demo() {
    // Defining the rendering function.
    $data = $this->customService->getName();
    return [
    // Rendering the template.
      '#theme' => 'controller_template',
    // Service value is passed.
      '#message' => $data,
    // Setting the hexcode color.
      '#hexcode' => '#FF0000',
    ];
  }

}
