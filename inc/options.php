<?php
/******************
 THEME OPTIONS PAGE
******************/

// Einstellungen registrieren (http://codex.wordpress.org/Function_Reference/register_setting)
add_action( 'admin_init', function(){
	register_setting( 'dpsg_options', 'dpsg_theme_options' );
    });

// Seite in der Dashboard-Navigation erstellen
add_action( 'admin_menu', function() {
	add_theme_page('Optionen', 'Theme Optionen', 'edit_theme_options', 'theme-optionen', 'dpsg_theme_options_page' ); // Seitentitel, Titel in der Navi, Berechtigung zum Editieren (http://codex.wordpress.org/Roles_and_Capabilities) , Slug, Funktion 
    });

// Optionen-Seite erstellen
function dpsg_theme_options_page() {
    global $select_options, $radio_options;
    if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false;
?>

<div class="wrap"> 
    <h2>Optionen für bootScore DPSG</h2> 

    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?> 
        <div class="updated fade">
	        <p><strong>Einstellungen gespeichert!</strong></p>
        </div>
    <?php endif; ?>

    <form method="post" action="options.php">

        <?php settings_fields( 'dpsg_options' ); ?>

        <h2>Startseiten Einstellungen</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Artikel-Slider</th>
                <td>
                    <label>
                        <input type="checkbox" id="dpsg_theme_options[swiper]" name="dpsg_theme_options[swiper]" value="true" <?php echo ( get_theme_option('swiper') == 'true' ) ? 'checked' : ''; ?> />
                        Zeige Sticky-Posts im Artikel-Slider auf der Startseite.
                        <p class="description" style="margin-left:1.3125rem">Plugin <a href="https://bootscore.me/documentation/bs-swiper/">bS Swiper</a> wird benötigt.</p>
                    </label>
                </td> 
            </tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <label>
                        <input type="checkbox" id="dpsg_theme_options[swiper_clean]" name="dpsg_theme_options[swiper_clean]" value="true" <?php echo ( get_theme_option('swiper_clean') == 'true' ) ? 'checked' : ''; ?> />
                        Verstecke Aritkelauszug und "Weiterlesen"-Link im Artikel-Slider.
                        <p class="description" style="margin-left:1.3125rem">
                            Nur bei aktiviertem Artikel-Slider.
                        </p>
                    </label>
                </td> 
            </tr>
            <tr valign="top"><td colspan="2"><hr /></td></tr>
            <tr valign="top">
                <th scope="row">Titel und Untertitel der Website</th>
                <td>
                    <label>
                        <input type="checkbox" id="dpsg_theme_options[title]" name="dpsg_theme_options[title]" value="true" <?php echo ( get_theme_option('title') == 'true' ) ? 'checked' : ''; ?> />
                        Verstecke Titel und Untertitel auf der Startseite.
                        <p class="description" style="margin-left:1.3125rem">
                            Betrifft nicht die Customizer Einstellung über der Navbar.
                        </p>
                    </label>
                </td>
            </tr>
            <tr valign="top"><td colspan="2"><hr /></td></tr>
            <tr valign="top">
                <th scope="row">Suche in Navbar</th>
                <td>
                    <label>
                        <input type="checkbox" id="dpsg_theme_options[search]" name="dpsg_theme_options[search]" value="true" <?php echo ( get_theme_option('search') == 'true' ) ? 'checked' : ''; ?> />
                        Zeige die Suche in der oberen Navigation an.
                    </label>
                </td>
            </tr>
            <tr valign="top"><td colspan="2"><hr /></td></tr>
            <tr valign="top">
                <th scope="row">Textauszüge</th>
                <td>
                    <input type="number" id="dpsg_theme_options[excerpt_length]" name="dpsg_theme_options[excerpt_length]" class="small-text" min="10" max="255" step="1" value="<?php echo ( get_theme_option('excerpt_length') != '' ) ? get_theme_option('excerpt_length') : '55'; ?>" /> Zeichen
                    <p class="description">
                        Das ist die Länge auf der die Artikel- und Seitentexte für die Vorschau automatisch gekürzt werden.
                    </p>
                </td> 
            </tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <label>
                        <input type="checkbox" id="dpsg_theme_options[excerpt]" name="dpsg_theme_options[excerpt]" value="true" <?php echo ( get_theme_option('excerpt') == 'true' ) ? 'checked' : ''; ?> />
                        Auf der Startseite keine vollständigen Artikel anzeigen, sondern alle Artikel nur mit Textauszügen darstellen.
                        <p class="description" style="margin-left:1.3125rem">
                            Auszüge können bei jeden Artikel selbst definiert werden. Falls nicht, wird der Artikeltext automatisch nach einer bestimmten länge gekürzt.
                        </p>
                    </label>
                </td> 
            </tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <label>
                        <input type="checkbox" id="dpsg_theme_options[stretched]" name="dpsg_theme_options[stretched]" value="true" <?php echo ( get_theme_option('stretched') == 'true' ) ? 'checked' : ''; ?> />
                        Mache die ganze Artikel-Karte klickbar ("Stretched-Link").
                        <p class="description" style="margin-left:1.3125rem">
                            Bezieht sich auf alle Ansichten (Archiv, Suche, Startseite, ...) wo Textauszüge anstatt ganze Artikle stehen.
                        </p>
                    </label>
                </td> 
            </tr>
        </table>
        <hr />
        <h2>Scoutnet Kalender Template</h2>
        <p>Um den Scoutnet Kalender mit dem passenden Template in eine Seite oder Sidebar einzubinden nutze folgendes Template: <code>dpsg</code>.</p>
        <p>Beispiel: <code>[snk elementcount="5" externalTemplateName="dpsg" ssid="3" /]</code>
        <!-- submit -->
        <p class="submit"><input type="submit" class="button-primary" value="Einstellungen speichern" /></p>

    </form>
</div>

<?php } ?>