<?php
/**
 * @file
 * Preprocess functions and theme function overrides.
 */

/**
 * Prepares variables for page templates.
 *
 * @see page.tpl.php
 */
function lateral_preprocess_page(&$variables) {
  $path = backdrop_get_path('theme', 'lateral');
  // Font stylesheets according to theme settings.
  if (theme_get_setting('font') == 'merriweather') {
    backdrop_add_css($path . '/css/merriweather.css');
  }
  elseif (theme_get_setting('font') == 'opensans') {
    backdrop_add_library('system', 'opensans', TRUE);
    backdrop_add_css($path . '/css/use-opensans.css');
  }
  else {
    backdrop_add_css($path . '/css/nowebfont.css');
  }
  // Header on the left or right side.
  if (theme_get_setting('header_position') == 'right') {
    backdrop_add_css($path . '/css/headerright.css');
    $variables['classes'][] = 'header-right';
  }
  else {
    backdrop_add_css($path . '/css/headerleft.css');
    $variables['classes'][] = 'header-left';
  }
}

/**
 * Prepares variables for layout templates.
 *
 * @see layout.tpl.php
 */
function lateral_preprocess_layout(&$variables) {
  // FIXME this only works with regular layouts with a "header" region.
  if (isset($variables['content']['header'])) {
    $header = '<div class="l-header-scrollable">' . $variables['content']['header'] . '</div>';
    $header .= '<div class="menu-toggle-button"><span class="menu-toggle-button-text">' . t('Menu') . '</span></div>';
    $variables['content']['header'] = $header;
  }
}

/**
 * Implements theme_menu_toggle().
 */
function lateral_menu_toggle() {
  return '';
}

/**
 * Implements hook_css_alter().
 *
 * Get rid of unneeded core css.
 */
function lateral_css_alter(&$css) {
  unset($css['core/modules/system/css/menu-dropdown.theme.css']);
  unset($css['core/modules/system/css/menu-toggle.theme.css']);
  // not sure yet...
  unset($css['core/misc/smartmenus/css/sm-core-css.css']);
}

/**
 * Implements hook_js_alter().
 *
 * Get rid of unneeded core js.
 */
function lateral_js_alter(&$javascript) {
  unset($javascript['core/modules/system/js/menus.js']);
}
