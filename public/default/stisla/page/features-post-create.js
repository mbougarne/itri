'use strict'

$("select").selectric();
$.uploadPreview({
  input_field: "#image-upload",   // Default: .image-upload
  preview_box: "#image-preview",  // Default: .image-preview
  label_field: "#image-label",    // Default: .image-label
  label_default: "Choose File",   // Default: Choose File
  label_selected: "Change File",  // Default: Change File
  no_label: false,                // Default: false
  success_callback: null          // Default: null
});

$(".inputtags").tagsinput('items');

$('.bootstrap-tagsinput input').on('keypress', function(e){
    if (e.keyCode == 13){
      e.keyCode = 188;
      e.preventDefault();
    };
});
