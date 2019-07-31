window.jQuery = window.$ = $ = require('jquery');
window.Vue = require('vue');
window.perfectScrollbar = require('perfect-scrollbar/jquery')($);
window.toastr = require('./toastr');
window.DataTable = require('./bootstrap-datatables');
window.SimpleMDE = require('simplemde');
window.tooltip = require('./bootstrap-tooltip');
window.MediaManager = require('./media');
require('dropzone');
require('./readmore');
require('./jquery-match-height');
require('./bootstrap-toggle');
require('./jquery-cookie');
require('./jquery-nestable');
require('bootstrap');
require('bootstrap-switch');
require('select2');
require('eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker');
var brace = require('brace');
require('brace/mode/json');
require('brace/theme/github');
require('./slugify');
window.TinyMCE = window.tinymce = require('./tinymce');
require('./multilingual');
require('./admin_tinymce');
require('./admin_ace_editor');
window.helpers = require('./helpers.js');
require('cropperjs');
window.Image = require('./cropper');

$(document).ready(function(){

    var appContainer = $(".app-container"),
        fadedOverlay = $('.fadetoblack'),
        hamburger = $('.hamburger');

  $('.side-menu').perfectScrollbar();

  $('#admin-loader').fadeOut();
  $('.readmore').readmore({
    collapsedHeight: 60,
    embedCSS: true,
    lessLink: '<a href="#" class="readm-link">Read Less</a>',
    moreLink: '<a href="#" class="readm-link">Read More</a>',
  });

  $(".hamburger, .navbar-expand-toggle").on('click', function() {
      appContainer.toggleClass("expanded");
      $(this).toggleClass('is-active');
      if ($(this).hasClass('is-active')) {
        window.localStorage.setItem('admin.stickySidebar', true);
      } else {
        window.localStorage.setItem('admin.stickySidebar', false);
      }
  });

  $('select.select2').select2({ width: '100%' });

  $('.match-height').matchHeight();

  $('.datatable').DataTable({
    "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
  });

  $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
    return $(".side-menu .nav .dropdown .collapse").collapse('hide');
  });

  $(document).on('click', '.panel-heading a.panel-action[data-toggle="panel-collapse"]', function(e){
    e.preventDefault();
    var $this = $(this);

    // Toggle Collapse
    if(!$this.hasClass('panel-collapsed')) {
      $this.parents('.panel').find('.panel-body').slideUp();
      $this.addClass('panel-collapsed');
      $this.removeClass('admin-angle-up').addClass('admin-angle-down');
    } else {
      $this.parents('.panel').find('.panel-body').slideDown();
      $this.removeClass('panel-collapsed');
      $this.removeClass('admin-angle-down').addClass('admin-angle-up');
    }
  });

  //Toggle fullscreen
  $(document).on('click', '.panel-heading a.panel-action[data-toggle="panel-fullscreen"]', function (e) {
    e.preventDefault();
    var $this = $(this);
    if (!$this.hasClass('admin-resize-full')) {
      $this.removeClass('admin-resize-small').addClass('admin-resize-full');
    } else {
      $this.removeClass('admin-resize-full').addClass('admin-resize-small');
    }
    $this.closest('.panel').toggleClass('is-fullscreen');
  });

	if ($('.datepicker').length) {
		$.each($('.datepicker'), function(i, datepicker){
			$(datepicker).datetimepicker($(datepicker).data('datetimepicker'));
		});
	}

	// Save shortcut
  $(document).keydown(function (e){
    if ((e.metaKey || e.ctrlKey) && e.keyCode == 83) { /*ctrl+s or command+s*/
      $(".btn.save").click();
      e.preventDefault();
      return false;
    }
  });

  /********** MARKDOWN EDITOR **********/

  $('textarea.simplemde').each(function() {
      var simplemde = new SimpleMDE({
          element: this,
      });
      simplemde.render();
  });

  /********** END MARKDOWN EDITOR **********/

});


$(document).ready(function(){
  $(".form-edit-add").submit(function(e){
    e.preventDefault();

    var url = $(this).attr('action');
    var form = $(this);
    var data = new FormData(this);

    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: data,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $("body").css("cursor", "progress");
        $("div").removeClass("has-error");
        $(".help-block").remove();
      },
      success: function(d){
        $("body").css("cursor", "auto");

        $.each(d.errors, function(key, row){
          //Scroll to first error
          if (Object.keys(d.errors).indexOf(key) === 0) {
              $('html, body').animate({
                  scrollTop: $("[name='"+key+"']").parent().offset().top
                          - $('nav.navbar').height() + 'px'
              }, 'fast');
          }

          $("[name='" + key + "']").parent().addClass("has-error");
          var errors = row.map(function(error){return error.replace(key, $("[name='" + key + "']").data('name').toLowerCase());});
          $("[name='" + key + "']").parent().append("<span class='help-block' style='color:#f96868'>" + errors + "</span>");
        });
      },
      error: function(){
        $(form).unbind("submit").submit();
      }
    });
  });
});
