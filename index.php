<?php  
	/*
	if ( !isset($_SESSION["login"])) {
		header("location: login.php");	
	}
	*/

	// conexao BD
	$bd = mysql_connect("localhost", "root", "root");
	if (!$bd) {
		die("Erro ao conectar-se (".mysql_error().")");
	}

	$select_db = mysql_select_db('movelsul_2014');
	if (!$select_db) {
		die("Erro ao selecionar base de dados (".mysql_error().")");
	}

	$sql = 	'
		SELECT 
			*
		FROM
			expositores
		ORDER BY
			nome
		ASC		
		';
	$query = mysql_query($sql);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Expositores Movelsul 2014</title>
		<link rel="shortcut icon" href="docs/images/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" href="docs/images/apple-touch-icon.png">
		<link id="data-uikit-theme" rel="stylesheet" href="docs/css/uikit.docs.min.css">
		<link rel="stylesheet" href="docs/css/docs.css">
		<link rel="stylesheet" href="vendor/highlight/highlight.css">
		<script src="vendor/jquery.js"></script>
		<script src="dist/js/uikit.min.js"></script>
		<script src="vendor/highlight/highlight.js"></script>
		<script src="docs/js/docs.js"></script>

		<style>
			.uk-width-medium-1-2 {margin-top: 10px !important;}
			.uk-panel {cursor: pointer;}
			.tm-footer a {
				color: inherit !important;
			}
			.tm-footer a:hover {
				color: inherit !important;
				text-decoration: none;
			}
		</style>
    </head>

    <body class="tm-background">

	<nav class="tm-navbar uk-navbar uk-navbar-attached">
	    <div class="uk-container uk-container-center" style="text-align:center">

			<a class="uk-navbar-brand uk-hidden-small" href="index.php" style="float:inherit">
				<img class="uk-margin" src="docs/images/logo_bravo.png" width="90" title="Bravo" alt="Bravo">
			</a>



			<a href="#tm-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>

			<div class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="docs/images/logo_uikit.svg" width="90" height="30" title="UIkit" alt="UIkit"></div>

	    </div>
	</nav>

	<div class="tm-section tm-section-color-white">
        <div class="uk-container uk-container-center uk-text-left">

            <h2>Expositores Movelsul 2014.</h2>

            <div class="uk-grid" data-uk-grid-match data-uk-grid-margin="15">

                <?php while ($row = mysql_fetch_array($query)) { ?>
					<div data-uk-scrollspy="{cls:'uk-animation-slide-top'}" class="uk-width-medium-1-2">
						<?php if($row['enviado'] == '1') { ?>
						<div class="uk-panel uk-panel-box uk-alert-success">
						<?php } else { ?>
						<div class="uk-panel uk-panel-box uk-alert-danger">
						<?php } ?>		
							<div data-uk-toggle="{target:'#id<?php echo($row['id']);?>'}" class="uk-text-primary">
								<?php echo ucwords(strtolower($row['nome'])); ?>
							</div>

							<div class="uk-hidden uk-text-muted" id="id<?php echo($row['id'])?>">
								<?php echo($row['fone'])?> <br>
							 	<a href="http://<?php echo($row['site'])?>" target="_blank"><?php echo($row['site'])?></a>  <br>
								<a href="mailto:<?php echo($row['email'])?>" target="_blank"><?php echo($row['email'])?></a> <br>

								<form class="uk-form">

								    <fieldset data-uk-margin>
								        <label for="enviado">
								        	<input type="checkbox" <?php if($row['enviado'] == '1') { ?> checked="checked" <?php } ?> name="enviado" class="enviado" id="<?php echo($row['id'])?>"> &nbsp;Enviado
								        </label>
								    </fieldset>
								</form>
								
							</div>
						</div>
					</div>
				<?php } ?>


				<script type="text/javascript">

					$(document).ready(function(){

						function makeChecked(id) {
							$.ajax({
								url: 'checked.php',
								type: 'POST',
					            data: { action:'checked', id:id },

								datatype: 'html',
								success: function(result) {
									// deixa o bkg da empresa verde
									$("#" + id).closest("div.uk-panel").removeClass("uk-alert-danger").addClass("uk-alert-success");
								},
								error: function() {
									alert("Erro!");	
								}
							});
						}

						function makeUnchecked(id) {
							$.ajax({
								url: 'checked.php',
								type: 'POST',
					            data: { action:'unchecked', id:id },

								datatype: 'html',
								success: function(result) {
									// deixa o bkg da empresa vermelho
									$("#" + id).closest("div.uk-panel").removeClass("uk-alert-success").addClass("uk-alert-danger");
								},
								error: function() {
									alert("Erro!");
								}
							});
						}


						$( ".enviado" ).change(function() {
							var id = $(this).attr("id");

							if($(this).is(":checked")) {
						  		makeChecked(id);
							} else {
						  		makeUnchecked(id);
							}
						});
					});	

						
				</script>

            </div>

        </div>
    </div>




	<div id="tm-offcanvas" class="uk-offcanvas">

	    <div class="uk-offcanvas-bar">

		<ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="{ multiple: true }">
		    <li class="uk-parent"><a href="#">Documentation</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/documentation_get-started.html">Get started</a></li>
			    <li><a href="docs/documentation_how-to-customize.html">How to customize</a></li>
			    <li><a href="docs/documentation_layouts.html">Layout examples</a></li>
			    <li><a href="docs/components.html">Components</a></li>
			    <li><a href="docs/addons.html">Add-ons</a></li>
			    <li><a href="docs/documentation_project-structure.html">Project structure</a></li>
			    <li><a href="docs/documentation_create-a-theme.html">Create a theme</a></li>
			    <li><a href="docs/documentation_create-a-style.html">Create a style</a></li>
			    <li><a href="docs/documentation_customizer-json.html">Customizer.json</a></li>
			    <li><a href="docs/documentation_javascript.html">Javascript</a></li>
			</ul>
		    </li>
		    <li class="uk-nav-header">Components</li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-wrench"></i> Defaults</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/normalize.html">Normalize</a></li>
			    <li><a href="docs/base.html">Base</a></li>
			    <li><a href="docs/print.html">Print</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-th-large"></i> Layout</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/grid.html">Grid</a></li>
			    <li><a href="docs/panel.html">Panel</a></li>
			    <li><a href="docs/article.html">Article</a></li>
			    <li><a href="docs/comment.html">Comment</a></li>
			    <li><a href="docs/utility.html">Utility</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-bars"></i> Navigations</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/nav.html">Nav</a></li>
			    <li><a href="docs/navbar.html">Navbar</a></li>
			    <li><a href="docs/subnav.html">Subnav</a></li>
			    <li><a href="docs/breadcrumb.html">Breadcrumb</a></li>
			    <li><a href="docs/pagination.html">Pagination</a></li>
			    <li><a href="docs/tab.html">Tab</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-check"></i> Elements</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/list.html">List</a></li>
			    <li><a href="docs/description-list.html">Description list</a></li>
			    <li><a href="docs/table.html">Table</a></li>
			    <li><a href="docs/form.html">Form</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-folder-open"></i> Common</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/button.html">Button</a></li>
			    <li><a href="docs/icon.html">Icon</a></li>
			    <li><a href="docs/close.html">Close</a></li>
			    <li><a href="docs/badge.html">Badge</a></li>
			    <li><a href="docs/alert.html">Alert</a></li>
			    <li><a href="docs/thumbnail.html">Thumbnail</a></li>
			    <li><a href="docs/overlay.html">Overlay</a></li>
			    <li><a href="docs/progress.html">Progress</a></li>
			    <li><a href="docs/text.html">Text</a></li>
			    <li><a href="docs/animation.html">Animation</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-magic"></i> JavaScript</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/dropdown.html">Dropdown</a></li>
			    <li><a href="docs/modal.html">Modal</a></li>
			    <li><a href="docs/offcanvas.html">Off-canvas</a></li>
			    <li><a href="docs/switcher.html">Switcher</a></li>
			    <li><a href="docs/toggle.html">Toggle</a></li>
			    <li><a href="docs/tooltip.html">Tooltip</a></li>
			    <li><a href="docs/scrollspy.html">Scrollspy</a></li>
			    <li><a href="docs/smooth-scroll.html">Smooth scroll</a></li>
			</ul>
		    </li>
		    <li class="uk-nav-header">Add-ons</li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-bars"></i> Navigations</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/addons_dotnav.html">Dotnav</a></li>
			    <li><a href="docs/addons_slidenav.html">Slidenav</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-folder-open"></i> Common</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/addons_form-file.html">Form file</a></li>
			    <li><a href="docs/addons_form-password.html">Form password</a></li>
			    <li><a href="docs/addons_placeholder.html">Placeholder</a></li>
			</ul>
		    </li>
		    <li class="uk-parent"><a href="#"><i class="uk-icon-magic"></i> JavaScript</a>
			<ul class="uk-nav-sub">
			    <li><a href="docs/addons_autocomplete.html">Autocomplete</a></li>
			    <li><a href="docs/addons_datepicker.html">Datepicker</a></li>
			    <li><a href="docs/addons_markdownarea.html">Markdown area</a></li>
			    <li><a href="docs/addons_notify.html">Notify</a></li>
			    <li><a href="docs/addons_search.html">Search</a></li>
			    <li><a href="docs/addons_sortable.html">Sortable</a></li>
			    <li><a href="docs/addons_sticky.html">Sticky</a></li>
			    <li><a href="docs/addons_timepicker.html">Timepicker</a></li>
			    <li><a href="docs/addons_upload.html">Upload</a></li>
			</ul>
		    </li>
		</ul>

	    </div>

	</div>

    </body>
</html>
