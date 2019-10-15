<?php

namespace Drupal\article_with_disclaimer\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use \Drupal\Core\Url;

class DisclaimerController extends ControllerBase {

  /**
   * Update 'Drupal_visitor_accepted_articles' cookie with accepted article id.
   *
   * @param string $node
   */
  public function accept($node) {
    $accepted_disclaimers_arr = [];
    $redirect_url = Url::fromRoute('entity.node.canonical', ['node' => $node])->toString();
    if (isset($_COOKIE['Drupal_visitor_accepted_articles'])) {
      $accepted_disclaimers = json_decode($_COOKIE['Drupal_visitor_accepted_articles']);
    }
    $accepted_disclaimers[] = $node;

    user_cookie_save(array('accepted_articles' => json_encode($accepted_disclaimers)));
    $response = new RedirectResponse($redirect_url);
    $response->send();
  }

}
