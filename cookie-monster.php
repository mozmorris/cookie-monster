<?php
/*
Plugin Name: Cookie Monster
Plugin URI: http://github.com/mozmorris/cookie-monster
Description: I like cookies.
Version: 0.1
Author: Moz Morris
Author URI: http://mozmorris.com
Author Email: moz@earthview.co.uk
License: MIT

Copyright (c) 2013 Moz Morris moz@earthview.co.uk

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE
*/

class CookieMonster {

  public $cookie_pref = null;

  /*--------------------------------------------*
   * Constructor
   *--------------------------------------------*/

  /**
   * Initializes the plugin by setting localization, filters, and administration functions.
   */
  function __construct() {

    // Load plugin text domain
    add_action( 'init', array( $this, 'plugin_textdomain' ) );

    // Register site styles and scripts
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

    // Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
    register_activation_hook( __FILE__, array( $this, 'activate' ) );
    register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );

    //Add the cookie bar markup
    add_action( 'wp_footer', array( $this, 'cookie_bar_markup' ));

    //Set cookie pref when JavaScript is disabled
    add_action( 'init', array( $this, 'cookie_pref' ));

  } // end constructor

  /**
   * Fired when the plugin is activated.
   *
   * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
   */
  public function activate( $network_wide ) {
    // TODO:  Define activation functionality here
  } // end activate

  /**
   * Fired when the plugin is deactivated.
   *
   * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
   */
  public function deactivate( $network_wide ) {
    // TODO:  Define deactivation functionality here
  } // end deactivate

  /**
   * Fired when the plugin is uninstalled.
   *
   * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
   */
  public function uninstall( $network_wide ) {
    // TODO:  Define uninstall functionality here
  } // end uninstall

  /**
   * Loads the plugin text domain for translation
   */
  public function plugin_textdomain() {

    $domain = 'cookie-monster-locale';
    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

  } // end plugin_textdomain

  /**
   * Registers and enqueues plugin-specific styles.
   */
  public function register_plugin_styles() {

    wp_enqueue_style( 'cookie-monster-plugin-styles', plugins_url( 'cookie-monster/css/display.css' ) );

  } // end register_plugin_styles

  /**
   * Registers and enqueues plugin-specific scripts.
   */
  public function register_plugin_scripts() {
    //Jquery Cookie Plugin
    wp_register_script( 'jquery.cookie', plugins_url( 'cookie-monster/js/jquery.cookie.js' ) );

    //Cookie monster scripts
    wp_enqueue_script( 'cookie-monster-plugin-script', plugins_url( 'cookie-monster/js/display.js' ), array( 'jquery.cookie' ));

  } // end register_plugin_scripts

  /*--------------------------------------------*
   * Core Functions
   *---------------------------------------------*/

  /**
   * Loads the cookie bar markup
   */
  public function cookie_bar_markup() {

    //Detect if the cookie pref as already been set
    $hide_cookie_bar = isset($_COOKIE['cookie-pref']) || current_user_can('manage_options') ? true : false;

    //Render output with vars
    $this->_render(array(
      'hide_cookie_bar' => $hide_cookie_bar || $this->cookie_pref
    ), realpath(dirname(__FILE__) . '/views/display.php'));
  } // end cookie_bar_markup

  /**
   * Sets cookie pref
   */
  public function cookie_pref() {

    //If request has a cookie pref
    if (isset($_GET['cookie-pref'])) {
      $this->cookie_pref = $_GET['cookie-pref'] ? true : 'false';
      setcookie('cookie-pref', $this->cookie_pref);
    }
  }

  /**
   * Renders the view
   */
  private function _render($vars, $file) {
    ob_start();
    extract($vars);
    include $file;
    echo ob_get_clean();
  }
} // end class

$cookie_monster = new CookieMonster();
