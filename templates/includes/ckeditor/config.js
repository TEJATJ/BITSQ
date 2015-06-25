/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.uiColor = '#565b60';
	config.toolbar = 'MyToolbar';
 config.skin = 'office2013';
 config.smiley_path=CKEDITOR.basePath+'plugins/smiley/images/';
 /*config.smiley_images=['angel_smile.gif', 'angry_smile.gif', 'broken_heart.gif', 'cake.gif', 'confused_smile.gif', 
 'cry_smile.gif', 'devil_smile.gif', 'embaressed_smile.gif', 'envelope.gif', 'heart.gif', 'kiss.gif', 'lightbulb.gif',
 'omg_smile.gif', 'regular_smile.gif', 'sad_smile.gif', 'shades_smile.gif', 'teeth_smile.gif', 'thumbs_down.gif', 'thumbs_up.gif', 
 'tounge_smile.gif', 'whatchutalkingabout_smile.gif', 'wink_smile.gif','graphics-3d.gif'];
 config.smiley_descriptions=['','', ':(', '', '', ':~', ':\'(', '', '', '', '', '', '', ':-O', ':-)', ':-(', '8-)', ':D', '', '', ':-P', ':|', ';-)'];*/
	config.toolbar_MyToolbar =
	[
		
		{ name: 'clipboard', items : ['Undo','Redo'] },
		{ name: 'editing', items : [ 'Find'] },
		{ name: 'insert', items : [ 'Smiley','SpecialChar','Iframe','Image'
                  ] },                
		{ name: 'styles', items : [ 'Styles'] },
		{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link' ] },
		
	];
	
};
