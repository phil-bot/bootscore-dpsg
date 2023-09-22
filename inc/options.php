<?php
/* ------------------ */
/* theme options page */
/* ------------------ */

/*** GET THEME OPTIONS  ***/

function get_theme_option( $option = '' ) {
	$options = get_option('dpsg_theme_options');
    if (is_array($options)) return $options[$option];
}

/*** ... ***/

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

// Einstellungen registrieren (http://codex.wordpress.org/Function_Reference/register_setting)
function theme_options_init(){
	register_setting( 'dpsg_options', 'dpsg_theme_options', 'dpsg_validate_options' );
}

// Seite in der Dashboard-Navigation erstellen
function theme_options_add_page() {
	add_theme_page('Optionen', 'Optionen', 'edit_theme_options', 'theme-optionen', 'dpsg_theme_options_page' ); // Seitentitel, Titel in der Navi, Berechtigung zum Editieren (http://codex.wordpress.org/Roles_and_Capabilities) , Slug, Funktion 
}

// Optionen-Seite erstellen
function dpsg_theme_options_page() {
global $select_options, $radio_options;
if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false; ?>

<div class="wrap"> 
<?php screen_icon(); ?><h2>Theme-Optionen für <?php bloginfo('name'); ?></h2> 

<?php if ( false !== $_REQUEST['settings-updated'] ) : ?> 
<div class="updated fade">
	<p><strong>Einstellungen gespeichert!</strong></p>
</div>
<?php endif; ?>

    <form method="post" action="options.php">
    <?php settings_fields( 'dpsg_options' ); ?>
    <h3>Startseite</h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Sticky-Posts</th>
            <td><label><input type="checkbox" id="dpsg_theme_options[swiper]" name="dpsg_theme_options[swiper]" value="true" <?php echo ( get_theme_option('swiper') == 'true' ) ? 'checked' : ''; ?> /> Zeige Sticky-Posts im Bootstrap-Carousel auf der Startseite.</label><p id="home-description" style="margin-left:1.5em;">Plugin <a href="https://bootscore.me/documentation/bs-swiper/">bS Swiper</a> wird benötigt</p></td> 
        </tr>
        <tr valign="top">
            <th scope="row">Titel und Untertitel</th>
            <td><label><input type="checkbox" id="dpsg_theme_options[title]" name="dpsg_theme_options[title]" value="true" <?php echo ( get_theme_option('title') == 'true' ) ? 'checked' : ''; ?> /> Verstecke Titel und Untertitel auf der Startseite.</label></td> 
        </tr>
        <tr valign="top">
            <th scope="row">Stretched</th>
            <td><label><input type="checkbox" id="dpsg_theme_options[stretched]" name="dpsg_theme_options[stretched]" value="true" <?php echo ( get_theme_option('stretched') == 'true' ) ? 'checked' : ''; ?> /></label></td> 
        </tr>
    </table>
    
    <!-- submit -->
    <p class="submit"><input type="submit" class="button-primary" value="Einstellungen speichern" /></p>
  </form>
</div>
<?php }

// Strip HTML-Code:
// Hier kann definiert werden, ob HTML-Code in einem Eingabefeld 
// automatisch entfernt werden soll. Soll beispielsweise im 
// Copyright-Feld KEIN HTML-Code erlaubt werden, kommentiert die Zeile 
// unten wieder ein. http://codex.wordpress.org/Function_Reference/wp_filter_nohtml_kses
function dpsg_validate_options( $input ) {
	// $input['copyright'] = wp_filter_nohtml_kses( $input['copyright'] );
	return $input;
}
?>