<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * Platon theme.
 */

/**
 * Implements hook_preprocess_page().
 */
function platon_preprocess_page(&$vars) {
  global $user;

  $vars['page']['admin_shortcuts'] = FALSE; // Prevent Notices.

  if (!empty($user->uid)) {
    $vars['secondary_nav'] = array_merge_recursive(array('my_account' => array(
      '#theme' => 'menu_link__user_menu',
      '#title' => t("welcome @user", array('@user' => $user->name)),
      '#href' => 'user',
      '#attributes' => array(
        'class' => array('first', 'my-account', 'user-name')
      ),
      '#localized_options' => array('alter' => TRUE),
      '#below' => array(),
    )), $vars['secondary_nav']);
  }
}

/**
 * Implements hook_js_alter().
 */
function platon_js_alter(&$javascript) {
  // Deactivate all Bootstrap JS, as well as the jQuery migrate plugin from OF. It messes up many modules.
  $path = drupal_get_path('theme', 'open_framework');
  foreach (array('/js/jquery-migrate-1.1.1.min.js', '/js/jquery-migrate-1.2.1.min.js', '/js/jquery-form-3.31.0.min.js', '/bootstrap/js/bootstrap.min.js') as $file) {
    unset($javascript[$path . $file]);
  }
  // Make sure we're using the core jQuery.
  $javascript['misc/jquery.js']['data'] = 'misc/jquery.js';
  $javascript['misc/jquery.js']['version'] = '1.4.4';
}