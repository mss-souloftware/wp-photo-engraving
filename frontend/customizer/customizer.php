<?php
/**
 * 
 * @package WP Photo Engraving
 * @subpackage M. Sufyan Shaikh
 * 
 */


function wppe_frontend()
{
    ob_start(); ?>

    <h1>Test</h1>

    <?php
    return ob_get_clean();
}