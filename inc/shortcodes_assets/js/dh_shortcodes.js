(function() {
	tinymce.PluginManager.add('dhshortcodes_options', function(editor, url){
		editor.addButton('dhshortcodesdisplay_button', {
			text: 'DH Shortcodes',
			icon: 'dh-logo',
			type: 'menubutton',
			menu: [
                {
                    text: 'Add Pilpil Image',
                    onclick: function(){
                        editor.windowManager.open({
                            title: 'Pilpil Lazy Image',
                            body: [
                                {
                                    type: 'textbox',
                                    id: 'image_id',
                                    name: 'image_id',
                                    label: 'Image ID',
                                    value: '',
                                    minWidth: 300,
                                },
                                /* description text of image_id */
                                {   
                                    type: 'container',
                                    html: '<p class="greyed small info-text">Open Media attachment popup by clicking on "Add Media", you\'ll see <b>selected</b> image\'s ID.</p>'
                                },
                                {
                                    type: 'listbox',
                                    name: 'image_size',
                                    label: 'Image Size',
                                    'values': [
                                    {text: 'HD (2000x1200)', value: 'hd'},
                                    {text: 'Cover (1480x460)', value: 'cover'},
                                    {text: 'Post (400x270)', value: 'post'},
                                    {text: 'Category (340x160)', value: 'category'},
                                    {text: 'Avatar (100x100)', value: 'avatar'},
                                    {text: 'Tiny (60x60)', value: 'tiny'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'pilpil_maxwidth',
                                    label: 'Wrapper\'s MaxWidth (optional)',
                                    value: '',
                                    minWidth: 300,
                                }                         
                            ],
                            onsubmit: function(e){
                                //this will prevent TinyMCE from closing the window dialog
                                e.preventDefault();

                                if (e.data.image_id === "") {
                                    jQuery('#image_id').addClass('damn_required');
                                }else{
                                    // validate so closing manually
                                    editor.windowManager.close();
                                    editor.insertContent('[pilpil id="' + e.data.image_id + '" size="' + e.data.image_size + '" maxwidth="'+ e.data.pilpil_maxwidth +'"]');
                                }
                            }
                        });
                    }
                },
                {
                    text: 'Layout One',
                    onclick: function(){
                        editor.windowManager.open({
                            title: 'Description Layout One',
                            body: [
                                /* layout image */
                                {   
                                    type: 'container',
                                    minHeight: 380,
                                    html: '<p class="greyed small info-text layout_image"><img width="560" height="380" src="../wp-content/themes/smartdevices/inc/shortcodes_assets/img/layout1.jpg" ></p>'
                                },
                                {
                                    type: 'textbox',
                                    id: 'layout_title',
                                    name: 'layout_title',
                                    label: 'Layout Title',
                                    value: '',
                                    minWidth: 300
                                },
                                {
                                  type   : 'checkbox',
                                  name   : 'title_under_image',
                                  label  : 'Title under image?',
                                  text   : 'Title under image?',
                                  checked : false
                                },
                                {
                                    type: 'textbox',
                                    id: 'image_id',
                                    name: 'image_id',
                                    label: 'Image ID',
                                    value: '',
                                    minWidth: 300,
                                },
                                {
                                    type: 'listbox',
                                    name: 'image_size',
                                    label: 'Image Size',
                                    'values': [
                                    {text: 'HD (2000x1200)', value: 'hd'},
                                    {text: 'Cover (1480x460)', value: 'cover'},
                                    {text: 'Post (400x270)', value: 'post'},
                                    {text: 'Category (340x160)', value: 'category'},
                                    {text: 'Avatar (100x100)', value: 'avatar'},
                                    {text: 'Tiny (60x60)', value: 'tiny'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'image_maxwidth',
                                    label: 'Image\'s MaxWidth (optional)',
                                    value: '',
                                    minWidth: 300,
                                }, 
                                {
                                    type: 'textbox',
                                    multiline: true,
                                    id: 'left_side_text',
                                    name: 'left_side_text',
                                    label: 'Left side text',
                                    value: '',
                                    minWidth: 300,
                                    minHeight: 300,
                                },                       
                                {
                                    type: 'textbox',
                                    multiline: true,
                                    id: 'right_side_text',
                                    name: 'right_side_text',
                                    label: 'Right side text',
                                    value: '',
                                    minWidth: 300,
                                    minHeight: 300,
                                },
                                {
                                  type   : 'checkbox',
                                  name   : 'dark_bg',
                                  label  : 'Dark Background',
                                  text   : 'Dark Background',
                                  checked : false
                                },
                                {
                                  type   : 'checkbox',
                                  name   : 'black_bg',
                                  label  : 'Black Background',
                                  text   : 'Black Background',
                                  checked : false
                                },
                                {
                                  type   : 'checkbox',
                                  name   : 'check_custom_color',
                                  label  : 'Custom Background & text color',
                                  text   : 'Custom Background & text color',
                                  checked : false
                                },
                                {
                                    type   : 'textbox', 
                                    name   : 'custom_bg_color',
                                    value: '',
                                    minWidth: 300,
                                    label  : 'Type BG color HEX value',
                                },
                                {
                                  type   : 'textbox', 
                                  name   : 'custom_text_color',
                                  value: '',
                                  minWidth: 300,
                                  label  : 'Type text color HEX value',
                                },                    
                                {
                                  type   : 'checkbox',
                                  name   : 'divider_top',
                                  label  : 'Divider on top',
                                  text   : 'Divider on top',
                                  checked : false
                                },
                                {
                                  type   : 'checkbox',
                                  name   : 'divider_bottom',
                                  label  : 'Divider on bottom',
                                  text   : 'Divider on bottom',
                                  checked : false
                                },
                            ],
                            onsubmit: function(e){
                                editor.insertContent('[layout_one divider_bottom="' + e.data.divider_bottom + '" divider_top="' + e.data.divider_top + '" title_under_image="' + e.data.title_under_image + '" custom_text_color="' + e.data.custom_text_color + '" custom_bg_color="' + e.data.custom_bg_color + '" dark_bg="' + e.data.dark_bg + '" black_bg="' + e.data.black_bg + '" check_custom_color="' + e.data.check_custom_color + '" layout_title="' + e.data.layout_title + '"  left_side_text="' + e.data.left_side_text + '" right_side_text="' + e.data.right_side_text + '" image_id="' + e.data.image_id + '" image_size="' + e.data.image_size + '" image_maxwidth="'+ e.data.image_maxwidth +'"]');
                            }
                        });
                    }
                },
                {
                    text: 'Layout Two',
                    onclick: function(){
                        editor.windowManager.open({
                            title: 'Description Layout Two',
                            body: [
                                /* layout image */
                                {   
                                    type: 'container',
                                    minWidth: 560,
                                    minHeight: 380,
                                    html: '<p class="greyed small info-text layout_image"><img width="560" height="380" src="../wp-content/themes/smartdevices/inc/shortcodes_assets/img/layout2.jpg" ></p>'
                                },
                                {
                                    type: 'textbox',
                                    id: 'layout_title',
                                    name: 'layout_title',
                                    label: 'Layout Title',
                                    value: '',
                                    minWidth: 300
                                },
                                {
                                    type: 'textbox',
                                    id: 'image_id',
                                    name: 'image_id',
                                    label: 'Image ID',
                                    value: '',
                                    minWidth: 300,
                                },
                                {
                                    type: 'listbox',
                                    name: 'image_size',
                                    label: 'Image Size',
                                    'values': [
                                    {text: 'HD (2000x1200)', value: 'hd'},
                                    {text: 'Cover (1480x460)', value: 'cover'},
                                    {text: 'Post (400x270)', value: 'post'},
                                    {text: 'Category (340x160)', value: 'category'},
                                    {text: 'Avatar (100x100)', value: 'avatar'},
                                    {text: 'Tiny (60x60)', value: 'tiny'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'image_maxwidth',
                                    label: 'Image\'s MaxWidth (optional)',
                                    value: '',
                                    minWidth: 300,
                                }, 
                                {
                                    type: 'textbox',
                                    multiline: true,
                                    id: 'right_side_text',
                                    name: 'right_side_text',
                                    label: 'Right side text',
                                    value: '',
                                    minWidth: 300,
                                    minHeight: 300,
                                },                       
                                {
                                    type: 'textbox',
                                    multiline: true,
                                    id: 'bottom_text',
                                    name: 'bottom_text',
                                    label: 'Bottom text',
                                    value: '',
                                    minWidth: 300,
                                    minHeight: 300,
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'dark_bg',
                                    label  : 'Dark Background',
                                    text   : 'Dark Background',
                                    checked : false
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'black_bg',
                                    label  : 'Black Background',
                                    text   : 'Black Background',
                                    checked : false
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'check_custom_color',
                                    label  : 'Custom Background & text color',
                                    text   : 'Custom Background & text color',
                                    checked : false
                                },
                                {
                                    type   : 'textbox', 
                                    name   : 'custom_bg_color',
                                    value: '',
                                    minWidth: 300,
                                    label  : 'Type BG color HEX value',
                                },
                                {
                                    type   : 'textbox', 
                                    name   : 'custom_text_color',
                                    value: '',
                                    minWidth: 300,
                                    label  : 'Type text color HEX value',
                                },                    
                                {
                                    type   : 'checkbox',
                                    name   : 'divider_top',
                                    label  : 'Divider on top',
                                    text   : 'Divider on top',
                                    checked : false
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'divider_bottom',
                                    label  : 'Divider on bottom',
                                    text   : 'Divider on bottom',
                                    checked : false
                                },
                            ],
                            onsubmit: function(e){
                                editor.insertContent('[layout_two divider_bottom="' + e.data.divider_bottom + '" divider_top="' + e.data.divider_top + '" custom_text_color="' + e.data.custom_text_color + '" custom_bg_color="' + e.data.custom_bg_color + '" dark_bg="' + e.data.dark_bg + '" black_bg="' + e.data.black_bg + '" check_custom_color="' + e.data.check_custom_color + '" layout_title="' + e.data.layout_title + '"  bottom_text="' + e.data.bottom_text + '" right_side_text="' + e.data.right_side_text + '" image_id="' + e.data.image_id + '" image_size="' + e.data.image_size + '" image_maxwidth="'+ e.data.image_maxwidth +'"]');
                            }
                        });
                    }
                },
                {
                    text: 'Layout Three',
                    onclick: function(){
                        editor.windowManager.open({
                            title: 'Description Layout Three',
                            body: [
                                /* layout image */
                                {   
                                    type: 'container',
                                    minWidth: 560,
                                    minHeight: 380,
                                    html: '<p class="greyed small info-text layout_image"><img width="560" height="380" src="../wp-content/themes/smartdevices/inc/shortcodes_assets/img/layout3.jpg" ></p>'
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'invert_whole',
                                    label  : 'Invert this whole thing? (view image)',
                                    text   : 'Invert this whole thing? (view image)',
                                    checked : false
                                },
                                {
                                    type: 'textbox',
                                    id: 'layout_title',
                                    name: 'layout_title',
                                    label: 'Layout Title',
                                    value: '',
                                    minWidth: 300
                                },
                                {
                                    type: 'textbox',
                                    id: 'image_id',
                                    name: 'image_id',
                                    label: 'Image ID',
                                    value: '',
                                    minWidth: 300,
                                },
                                {
                                    type: 'listbox',
                                    name: 'image_size',
                                    label: 'Image Size',
                                    'values': [
                                    {text: 'HD (2000x1200)', value: 'hd'},
                                    {text: 'Cover (1480x460)', value: 'cover'},
                                    {text: 'Post (400x270)', value: 'post'},
                                    {text: 'Category (340x160)', value: 'category'},
                                    {text: 'Avatar (100x100)', value: 'avatar'},
                                    {text: 'Tiny (60x60)', value: 'tiny'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'image_maxwidth',
                                    label: 'Image\'s MaxWidth (optional)',
                                    value: '',
                                    minWidth: 300,
                                }, 
                                {
                                    type: 'textbox',
                                    multiline: true,
                                    id: 'side_text',
                                    name: 'side_text',
                                    label: 'Side text',
                                    value: '',
                                    minWidth: 300,
                                    minHeight: 300,
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'dark_bg',
                                    label  : 'Dark Background',
                                    text   : 'Dark Background',
                                    checked : false
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'black_bg',
                                    label  : 'Black Background',
                                    text   : 'Black Background',
                                    checked : false
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'check_custom_color',
                                    label  : 'Custom Background & text color',
                                    text   : 'Custom Background & text color',
                                    checked : false
                                },
                                {
                                    type   : 'textbox', 
                                    name   : 'custom_bg_color',
                                    value: '',
                                    minWidth: 300,
                                    label  : 'Type BG color HEX value',
                                },
                                {
                                    type   : 'textbox', 
                                    name   : 'custom_text_color',
                                    value: '',
                                    minWidth: 300,
                                    label  : 'Type text color HEX value',
                                },                    
                                {
                                    type   : 'checkbox',
                                    name   : 'divider_top',
                                    label  : 'Divider on top',
                                    text   : 'Divider on top',
                                    checked : false
                                },
                                {
                                    type   : 'checkbox',
                                    name   : 'divider_bottom',
                                    label  : 'Divider on bottom',
                                    text   : 'Divider on bottom',
                                    checked : false
                                },
                            ],
                            onsubmit: function(e){
                                editor.insertContent('[layout_three invert_whole="' + e.data.invert_whole + '" divider_bottom="' + e.data.divider_bottom + '" divider_top="' + e.data.divider_top + '" custom_text_color="' + e.data.custom_text_color + '" custom_bg_color="' + e.data.custom_bg_color + '" dark_bg="' + e.data.dark_bg + '" black_bg="' + e.data.black_bg + '" check_custom_color="' + e.data.check_custom_color + '" layout_title="' + e.data.layout_title + '" side_text="' + e.data.side_text + '" image_id="' + e.data.image_id + '" image_size="' + e.data.image_size + '" image_maxwidth="'+ e.data.image_maxwidth +'"]');
                            }
                        });
                    }
                }
			]
		});
});
})();

