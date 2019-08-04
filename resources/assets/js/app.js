window.jQuery = window.$ = $ = require('jquery');
window.Vue = require('vue');
window.perfectScrollbar = require('perfect-scrollbar/jquery')($);
window.Cropper = require('cropperjs');
window.Cropper = 'default' in window.Cropper ? window.Cropper['default'] : window.Cropper;
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

	//maxlength
	(function(){var j=false;window.JQClass=function(){};JQClass.classes={};JQClass.extend=function extender(f){var g=this.prototype;j=true;var h=new this();j=false;for(var i in f){h[i]=typeof f[i]=='function'&&typeof g[i]=='function'?(function(d,e){return function(){var b=this._super;this._super=function(a){return g[d].apply(this,a||[])};var c=e.apply(this,arguments);this._super=b;return c}})(i,f[i]):f[i]}function JQClass(){if(!j&&this._init){this._init.apply(this,arguments)}}JQClass.prototype=h;JQClass.prototype.constructor=JQClass;JQClass.extend=extender;return JQClass}})();(function($){JQClass.classes.JQPlugin=JQClass.extend({name:'plugin',defaultOptions:{},regionalOptions:{},_getters:[],_getMarker:function(){return'is-'+this.name},_init:function(){$.extend(this.defaultOptions,(this.regionalOptions&&this.regionalOptions[''])||{});var c=camelCase(this.name);$[c]=this;$.fn[c]=function(a){var b=Array.prototype.slice.call(arguments,1);if($[c]._isNotChained(a,b)){return $[c][a].apply($[c],[this[0]].concat(b))}return this.each(function(){if(typeof a==='string'){if(a[0]==='_'||!$[c][a]){throw'Unknown method: '+a;}$[c][a].apply($[c],[this].concat(b))}else{$[c]._attach(this,a)}})}},setDefaults:function(a){$.extend(this.defaultOptions,a||{})},_isNotChained:function(a,b){if(a==='option'&&(b.length===0||(b.length===1&&typeof b[0]==='string'))){return true}return $.inArray(a,this._getters)>-1},_attach:function(a,b){a=$(a);if(a.hasClass(this._getMarker())){return}a.addClass(this._getMarker());b=$.extend({},this.defaultOptions,this._getMetadata(a),b||{});var c=$.extend({name:this.name,elem:a,options:b},this._instSettings(a,b));a.data(this.name,c);this._postAttach(a,c);this.option(a,b)},_instSettings:function(a,b){return{}},_postAttach:function(a,b){},_getMetadata:function(d){try{var f=d.data(this.name.toLowerCase())||'';f=f.replace(/'/g,'"');f=f.replace(/([a-zA-Z0-9]+):/g,function(a,b,i){var c=f.substring(0,i).match(/"/g);return(!c||c.length%2===0?'"'+b+'":':b+':')});f=$.parseJSON('{'+f+'}');for(var g in f){var h=f[g];if(typeof h==='string'&&h.match(/^new Date\((.*)\)$/)){f[g]=eval(h)}}return f}catch(e){return{}}},_getInst:function(a){return $(a).data(this.name)||{}},option:function(a,b,c){a=$(a);var d=a.data(this.name);if(!b||(typeof b==='string'&&c==null)){var e=(d||{}).options;return(e&&b?e[b]:e)}if(!a.hasClass(this._getMarker())){return}var e=b||{};if(typeof b==='string'){e={};e[b]=c}this._optionsChanged(a,d,e);$.extend(d.options,e)},_optionsChanged:function(a,b,c){},destroy:function(a){a=$(a);if(!a.hasClass(this._getMarker())){return}this._preDestroy(a,this._getInst(a));a.removeData(this.name).removeClass(this._getMarker())},_preDestroy:function(a,b){}});function camelCase(c){return c.replace(/-([a-z])/g,function(a,b){return b.toUpperCase()})}$.JQPlugin={createPlugin:function(a,b){if(typeof a==='object'){b=a;a='JQPlugin'}a=camelCase(a);var c=camelCase(b.name);JQClass.classes[c]=JQClass.classes[a].extend(b);new JQClass.classes[c]()}}})(jQuery);
	(function($){var h='maxlength';$.JQPlugin.createPlugin({name:h,defaultOptions:{max:200,truncate:true,showFeedback:true,feedbackTarget:null,onFull:null},regionalOptions:{'':{feedbackText:'{r} characters remaining ({m} maximum)',overflowText:'{o} characters too many ({m} maximum)'}},_getters:['curLength'],_feedbackClass:h+'-feedback',_fullClass:h+'-full',_overflowClass:h+'-overflow',_disabledClass:h+'-disabled',_instSettings:function(a,b){return{feedbackTarget:$([])}},_postAttach:function(c,d){c.on('keypress.'+d.name,function(a){if(!d.options.truncate){return true}var b=String.fromCharCode(a.charCode==undefined?a.keyCode:a.charCode);return(a.ctrlKey||a.metaKey||b=='\u0000'||$(this).val().length<d.options.max)}).on('keyup.'+d.name+' paste.'+d.name+' cut.'+d.name,function(e){if(e.type==='keyup'){$.maxlength._checkLength(c)}else{setTimeout(function(){$.maxlength._checkLength(c)},1)}})},_optionsChanged:function(a,b,c){$.extend(b.options,c);if(b.feedbackTarget.length>0){if(b.hadFeedbackTarget){b.feedbackTarget.empty().val('').removeClass(this._feedbackClass+' '+this._fullClass+' '+this._overflowClass)}else{b.feedbackTarget.remove()}b.feedbackTarget=$([])}if(b.options.showFeedback){b.hadFeedbackTarget=!!b.options.feedbackTarget;if($.isFunction(b.options.feedbackTarget)){b.feedbackTarget=b.options.feedbackTarget.apply(a[0],[])}else if(b.options.feedbackTarget){b.feedbackTarget=$(b.options.feedbackTarget)}else{b.feedbackTarget=$('<div></div>').insertAfter(a)}b.feedbackTarget.addClass(this._feedbackClass)}a.off('mouseover.'+b.name+' focus.'+b.name+'mouseout.'+b.name+' blur.'+b.name);if(b.options.showFeedback=='active'){a.on('mouseover.'+b.name,function(){b.feedbackTarget.css('visibility','visible')}).on('mouseout.'+b.name,function(){if(!b.focussed){b.feedbackTarget.css('visibility','hidden')}}).on('focus.'+b.name,function(){b.focussed=true;b.feedbackTarget.css('visibility','visible')}).on('blur.'+b.name,function(){b.focussed=false;b.feedbackTarget.css('visibility','hidden')});b.feedbackTarget.css('visibility','hidden')}this._checkLength(a)},curLength:function(a){var b=this._getInst(a);var c=a.val();var d=c.replace(/\r\n/g,'~~').replace(/\n/g,'~~').length;return{used:d,remaining:b.options.max-d}},_checkLength:function(a){var b=this._getInst(a);var c=a.val();var d=c.replace(/\r\n/g,'~~').replace(/\n/g,'~~').length;a.toggleClass(this._fullClass,d>=b.options.max).toggleClass(this._overflowClass,d>b.options.max);if(d>b.options.max&&b.options.truncate){var f=a.val().split(/\r\n|\n/);c='';var i=0;while(c.length<b.options.max&&i<f.length){c+=f[i].substring(0,b.options.max-c.length)+'\r\n';i++}a.val(c.substring(0,b.options.max));a[0].scrollTop=a[0].scrollHeight;d=b.options.max}b.feedbackTarget.toggleClass(this._fullClass,d>=b.options.max).toggleClass(this._overflowClass,d>b.options.max);var g=(d>b.options.max?b.options.overflowText:b.options.feedbackText).replace(/\{c\}/,d).replace(/\{m\}/,b.options.max).replace(/\{r\}/,b.options.max-d).replace(/\{o\}/,d-b.options.max);try{b.feedbackTarget.text(g)}catch(e){}try{b.feedbackTarget.val(g)}catch(e){}if(d>=b.options.max&&$.isFunction(b.options.onFull)){b.options.onFull.apply(a,[d>b.options.max])}},enable:function(a){a=$(a);if(!a.hasClass(this._getMarker())){return}var b=this._getInst(a);a.prop('disabled',false).removeClass(b.name+'-disabled');b.feedbackTarget.removeClass(b.name+'-disabled')},disable:function(a){a=$(a);if(!a.hasClass(this._getMarker())){return}var b=this._getInst(a);a.prop('disabled',true).addClass(b.name+'-disabled');b.feedbackTarget.addClass(b.name+'-disabled')},_preDestroy:function(a,b){if(b.feedbackTarget.length>0){if(b.hadFeedbackTarget){b.feedbackTarget.empty().val('').css('visibility','visible').removeClass(this._feedbackClass+' '+this._fullClass+' '+this._overflowClass)}else{b.feedbackTarget.remove()}}a.removeClass(this._fullClass+' '+this._overflowClass).off('.'+b.name)}})})(jQuery);
	(function($) { // hide the namespace
		$.maxlength.regionalOptions['fr'] = {
			feedbackText: '{r} осталось из {m}',
			overflowText: '{o} осталось из {m}'
		};
		$.maxlength.setDefaults($.maxlength.regionalOptions['fr']);
	})(jQuery);

	var details;
	var inputs = $("form.form-edit-add").find(':text, textarea');
	var validation;
	var maxlength;
	if (inputs.length) {
		inputs.each(function(key, input){
			details = $(input).data('details');
			if (details != null) {
				if (details.validation != null) {
					validation = details.validation;
					if (validation.rule.split('max:')[1] != null) {
						maxlength = validation.rule.split('max:')[1].split('|')[0];
						$(input).maxlength({max: maxlength});
					}
				}
			}
		});
	}
//end maxlength

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
