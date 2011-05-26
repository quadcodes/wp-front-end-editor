<?php

/**
 * This class handles all aloha specific actions like configuration and script dependency management
 * It will provide aloha editor version 0.9.3
 */
abstract class FEE_AlohaEditor {

	/**
	 * Enqueues the aloha editor dependencies depending on user status.
	 * Enqueuing will only performed if the user is loggedin and outsite
	 * of the admin area (dashboard).
	 */
	static function enqueueAloha() {
		if (is_user_logged_in() && !is_admin()) {
			wp_enqueue_script('aloha-plugin-format');
			wp_enqueue_script('aloha-plugin-link');
			wp_enqueue_script('aloha-plugin-list');
			wp_enqueue_script('aloha-plugin-table');
			wp_enqueue_script('aloha-plugin-fee');
			wp_enqueue_script('aloha-plugin-imagewp');

			if (defined('ALOHA_FEE_EXPERIMENTAL')) {
				wp_enqueue_script('aloha-plugin-image');
				wp_enqueue_script('aloha-plugin-draganddropfiles');
			}
		}
	}

	/**
	 * Registers the aloha editor depdencies and plugins
	 */
	static function registerAloha() {
		$alohaSrcBaseUrl = plugins_url('aloha-editor/WebContent/', FRONT_END_EDITOR_MAIN_FILE);
		$alohaPluginsBaseUrl = plugins_url('aloha-editor/WebContent/plugins/', FRONT_END_EDITOR_MAIN_FILE);
		$alohaCustomPluginsBaseUrl = plugins_url('aloha-plugins/', FRONT_END_EDITOR_MAIN_FILE);

		//Include no deps version for development
		if (defined('SCRIPT_DEBUG')) {

		// Aloha Deps
		wp_register_script('jquery-json', $alohaSrcBaseUrl . 'deps/jquery.json-2.2.min.js', array (), '0.9.3', false);
		wp_register_script('jquery-getUrlParam', $alohaSrcBaseUrl . 'deps/jquery.getUrlParam.js', array (), '0.9.3', false);
		wp_register_script('jquery-prettyPhoto', $alohaSrcBaseUrl . 'deps/prettyPhoto/jquery.prettyPhoto.js', array (), '0.9.3', false);
		wp_register_script('jquery-cookie', $alohaSrcBaseUrl . 'deps/jquery.cookie.js', array (), '0.9.3', false);
		wp_register_script('ext-jquery-adapter-debug', $alohaSrcBaseUrl . 'deps/extjs/ext-jquery-adapter-debug.js', array (), '0.9.3', false);
		wp_register_script('ext-foundation-debug', $alohaSrcBaseUrl . 'deps/extjs/ext-foundation-debug.js', array (), '0.9.3', false);
		wp_register_script('cmp-foundation-debug', $alohaSrcBaseUrl . 'deps/extjs/cmp-foundation-debug.js', array (), '0.9.3', false);

		wp_register_script('data-foundation-debug', $alohaSrcBaseUrl . 'deps/extjs/data-foundation-debug.js', array (), '0.9.3', false);
		wp_register_script('data-json-debug', $alohaSrcBaseUrl . 'deps/extjs/data-json-debug.js', array (), '0.9.3', false);
		wp_register_script('data-list-views-debug', $alohaSrcBaseUrl . 'deps/extjs/data-list-views-debug.js', array (), '0.9.3', false);
		wp_register_script('ext-dd.debug', $alohaSrcBaseUrl . 'deps/extjs/ext-dd-debug.js', array (), '0.9.3', false);
		wp_register_script('window-debug', $alohaSrcBaseUrl . 'deps/extjs/window-debug.js', array (), '0.9.3', false);
		wp_register_script('resizable-debug', $alohaSrcBaseUrl . 'deps/extjs/resizable-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-buttons-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-buttons-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-tabs-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-tabs-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-tips-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-tips-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-tree-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-tree-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-grid-foundation-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-grid-foundation-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-toolbars-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-toolbars-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-menu-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-menu-debug.js', array (), '0.9.3', false);
		wp_register_script('pkg-forms-debug', $alohaSrcBaseUrl . 'deps/extjs/pkg-forms-debug.js', array (), '0.9.3', false);

		// Aloha JQuery Deps
		wp_register_script('jquery-aloha.ext', $alohaSrcBaseUrl .  'utils/jquery.js', array (), '0.9.3', false);

		// Other deps
		wp_register_script('aloha-lang', $alohaSrcBaseUrl . 'utils/lang.js', array (), '0.9.3', false);
		wp_register_script('aloha-range', $alohaSrcBaseUrl . 'utils/range.js', array (), '0.9.3', false);
		wp_register_script('aloha-position', $alohaSrcBaseUrl . 'utils/position.js', array (), '0.9.3', false);
		wp_register_script('aloha-dom', $alohaSrcBaseUrl . 'utils/dom.js', array (), '0.9.3', false);
		wp_register_script('aloha-indexof', $alohaSrcBaseUrl . 'utils/indexof.js', array (), '0.9.3', false);
		wp_register_script('aloha-license', $alohaSrcBaseUrl . 'core/license.js', array (), '0.9.3', false);
		wp_register_script('ext-alohaproxy', $alohaSrcBaseUrl . 'core/ext-alohaproxy.js', array (), '0.9.3', false);
		wp_register_script('ext-alohareader',$alohaSrcBaseUrl . 'core/ext-alohareader.js', array (), '0.9.3', false);
		wp_register_script('ext-alohatreeloader',$alohaSrcBaseUrl.'core/ext-alohatreeloader.js', array (), '0.9.3', false);


		// register core dependencies
		wp_register_script('aloha-core', $alohaSrcBaseUrl . 'core/core.js', array (
			'jquery',
			'jquery-json',
			'jquery-getUrlParam',
			'jquery-prettyPhoto',
			'jquery-cookie',
			'ext-jquery-adapter-debug',
			'ext-foundation-debug',
			'cmp-foundation-debug',
			'data-foundation-debug',
			'data-json-debug',
			'data-list-views-debug',
			'ext-dd.debug',
			'window-debug',
			'resizable-debug',
			'pkg-buttons-debug',
			'pkg-tabs-debug',
			'pkg-tips-debug',
			'pkg-tree-debug',
			'pkg-grid-foundation-debug',
			'pkg-toolbars-debug',
			'pkg-menu-debug',
			'pkg-forms-debug',
			'jquery-aloha.ext',
			'aloha-lang',
			'aloha-range',
			'aloha-position',
			'aloha-dom',
			'aloha-indexof',
			'aloha-license',
			'ext-alohaproxy',
			'ext-alohareader',
			'ext-alohatreeloader'
		), '0.9.3', false);


		// register ui scripts
		wp_register_script('aloha-ui', $alohaSrcBaseUrl . 'core/ui.js', array (), '0.9.3', false);
		wp_register_script('aloha-ui-attributefield', $alohaSrcBaseUrl . 'core/ui-attributefield.js', array (), '0.9.3', false);
		wp_register_script('aloha-ui-browser', $alohaSrcBaseUrl . 'core/ui-browser.js', array (), '0.9.3', false);
		wp_register_script('aloha-css', $alohaSrcBaseUrl . 'core/css.js', array (), '0.9.3', false);
		wp_register_script('aloha-editable', $alohaSrcBaseUrl . 'core/editable.js', array (), '0.9.3', false);
		wp_register_script('aloha-ribbon', $alohaSrcBaseUrl . 'core/ribbon.js', array (), '0.9.3', false);
		wp_register_script('aloha-event', $alohaSrcBaseUrl . 'core/event.js', array (), '0.9.3', false);
		wp_register_script('aloha-floatingmenu', $alohaSrcBaseUrl . 'core/floatingmenu.js', array (), '0.9.3', false);
		wp_register_script('aloha-ierange-m2', $alohaSrcBaseUrl . 'core/ierange-m2.js', array (), '0.9.3', false);
		wp_register_script('aloha-jquery.aloha', $alohaSrcBaseUrl . 'core/jquery.aloha.js', array (), '0.9.3', false);
		wp_register_script('aloha-log', $alohaSrcBaseUrl . 'core/log.js', array (), '0.9.3', false);
		wp_register_script('aloha-markup', $alohaSrcBaseUrl . 'core/markup.js', array (), '0.9.3', false);
		wp_register_script('aloha-message', $alohaSrcBaseUrl . 'core/message.js', array (), '0.9.3', false);
		wp_register_script('aloha-plugin', $alohaSrcBaseUrl . 'core/plugin.js', array (), '0.9.3', false);
		wp_register_script('aloha-selection', $alohaSrcBaseUrl . 'core/selection.js', array (), '0.9.3', false);
		wp_register_script('aloha-sidebar', $alohaSrcBaseUrl . 'core/sidebar.js', array (), '0.9.3', false);
		wp_register_script('aloha-repositorymanager', $alohaSrcBaseUrl . 'core/repositorymanager.js', array (), '0.9.3', false);
		wp_register_script('aloha-repository', $alohaSrcBaseUrl . 'core/repository.js', array (), '0.9.3', false);
		wp_register_script('aloha-repositoryobjects', $alohaSrcBaseUrl . 'core/repositoryobjects.js', array (), '0.9.3', false);

		$plugindeps = array (
			'aloha-core',
			'aloha-ui',
			'aloha-ui-attributefield',
			'aloha-ui-browser',
			'aloha-css',
			'aloha-editable',
			'aloha-ribbon',
			'aloha-event',
			'aloha-floatingmenu',
			'aloha-ierange-m2',
			'aloha-jquery.aloha',
			'aloha-log',
			'aloha-markup',
			'aloha-message',
			'aloha-plugin',
			'aloha-selection',
			'aloha-sidebar',
			'aloha-repositorymanager',
			'aloha-repository',
			'aloha-repositoryobjects'
		);


		// register plugins
		wp_register_script('aloha-plugin-format', $alohaPluginsBaseUrl . 'com.gentics.aloha.plugins.Format/plugin.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-table', $alohaPluginsBaseUrl . 'com.gentics.aloha.plugins.Table/plugin.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-list',  $alohaPluginsBaseUrl . 'com.gentics.aloha.plugins.List/plugin.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-link', $alohaPluginsBaseUrl . 'com.gentics.aloha.plugins.Link/plugin.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-highlighteditables', $alohaPluginsBaseUrl . 'com.gentics.aloha.plugins.HighlightEditables/plugin.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-TOC', $alohaPluginsBaseUrl .'com.gentics.aloha.plugins.TOC/plugin.js' ,$plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-delicious', $alohaPluginsBaseUrl .'com.gentics.aloha.plugins.Link/delicious.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-link', $alohaPluginsBaseUrl .'com.gentics.aloha.plugins.Link/LinkList.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-paste', $alohaPluginsBaseUrl . 'com.gentics.aloha.plugins.Paste/plugin.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-wordpastehandler', $alohaPluginsBaseUrl .'com.gentics.aloha.plugins.Paste/wordpastehandler.js', $plugindeps, '0.9.3', false);
		wp_register_script('aloha-plugin-fee', $alohaCustomPluginsBaseUrl. 'com.gentics.aloha.plugins.FEE/plugin.js',$plugindeps,'0.9.3',false);
		wp_register_script('aloha-plugin-imagewp', $alohaCustomPluginsBaseUrl. 'com.gentics.aloha.plugins.ImageWP/plugin.js',$plugindeps,'0.9.3',false);

		// Image Plugin
		wp_register_script('aloha-plugin-image', $alohaCustomPluginsBaseUrl . 'com.gentics.aloha.plugins.image/plugin.js',$plugindeps,'0.9.3',false);
		// Drag and Drop plugin
		wp_register_script('aloha-plugin-draganddropfiles.xhruploader', $alohaCustomPluginsBaseUrl . 'com.gentics.aloha.plugins.DragAndDropFiles/deps/Ext.ux.XHRUpload.js',array(),'0.9.3',false);
		//wp_register_script('aloha-plugin-draganddropfiles.uploader', $alohaCustomPluginsBaseUrl . 'com.gentics.aloha.plugins.DragAndDropFiles/lib/uploader.js',array(),'0.9.3',false);
		wp_register_script('aloha-plugin-draganddropfiles.repository', $alohaCustomPluginsBaseUrl . 'com.gentics.aloha.plugins.DragAndDropFiles/lib/DropFilesRepository.js',array(),'0.9.3',false);

		$dragAndDropDependencies = array('aloha-plugin-draganddropfiles.xhruploader','aloha.draganddropfiles.repository','aloha.image');
		wp_register_script('aloha-plugin-draganddropfiles', $alohaCustomPluginsBaseUrl . 'com.gentics.aloha.plugins.DragAndDropFiles/plugin.js',$dragAndDropDependencies,'0.9.3',false);
		} else {
			//TODO decide whether we should use the build version
		}
	}
}
