﻿/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
		config.filebrowserBrowseUrl =       '/bundles/krsolutionskrcms/kcfinder/browse.php?type=files';
        config.filebrowserImageBrowseUrl =  '/bundles/krsolutionskrcms/kcfinder/browse.php?type=images';
        config.filebrowserFlashBrowseUrl =  '/bundles/krsolutionskrcms/kcfinder/browse.php?type=flash';
        config.filebrowserUploadUrl =       '/bundles/krsolutionskrcms/kcfinder/upload.php?type=files';
        config.filebrowserImageUploadUrl =  '/bundles/krsolutionskrcms/kcfinder/upload.php?type=images';
        config.filebrowserFlashUploadUrl =  '/bundles/krsolutionskrcms/kcfinder/upload.php?type=flash';
};
