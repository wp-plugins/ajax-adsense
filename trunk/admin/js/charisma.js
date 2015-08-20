$(document).ready(function () {

  var msie = navigator.userAgent.match(/msie/i);
  $.browser = {};
  $.browser.msie = {};

  $('.navbar-toggle').click(function (e) {
    e.preventDefault();
    $('.nav-sm').html($('.navbar-collapse').html());
    $('.sidebar-nav').toggleClass('active');
    $(this).toggleClass('active');
  });

  var $sidebarNav = $('.sidebar-nav');

  // Hide responsive navbar on clicking outside
  $(document).mouseup(function (e) {
    if (!$sidebarNav.is(e.target) // if the target of the click isn't the container...
            && $sidebarNav.has(e.target).length === 0
            && !$('.navbar-toggle').is(e.target)
            && $('.navbar-toggle').has(e.target).length === 0
            && $sidebarNav.hasClass('active')
            )// ... nor a descendant of the container
    {
      e.stopPropagation();
      $('.navbar-toggle').click();
    }
  });

  //disbaling some functions for Internet Explorer
  if (msie) {
    $('#is-ajax').prop('checked', false);
    $('#for-is-ajax').hide();
    $('#toggle-fullscreen').hide();
    $('.login-box').find('.input-large').removeClass('span10');

  }

  //highlight current / active link
  $('ul.main-menu li a').each(function (i, a) {
    if (a.href === String(window.location)) {
      var dad = a.parentElement;
      $(dad).addClass('active');
      var grandpa = $(dad).parent().closest('li.dropdown');
      grandpa.addClass('active');
    }
  });

  $('.accordion > a, .dropdown > a').click(function (e) {
    e.preventDefault();
    var $ul = $(this).siblings('ul');
    var $li = $(this).parent();
    var $others = $li.siblings('.accordion').children('ul');
    $li.removeClass('active');
    $ul.slideDown(function () {
      $ul.children('li:first').children('a:first')[0].click();
    });
    $others.slideUp().parent().removeClass('active');
  });

  $('.accordion li.active:first').parents('ul').slideDown(0);

  //other things to do on document ready, separated for ajax calls
  docReady();
});

function ezPopUp(url, title, w, h) {
  var wLeft = window.screenLeft ? window.screenLeft : window.screenX;
  var wTop = window.screenTop ? window.screenTop : window.screenY;
  var left = wLeft + (window.innerWidth / 2) - (w / 2);
  var top = wTop + (window.innerHeight / 2) - (h / 2);
  window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
  return true;
}

function docReady() {
  //prevent # links from moving to top
  $('a[href="#"][data-top!=true]').click(function (e) {
    e.preventDefault();
  });

  //notifications
  $('.noty').click(function (e) {
    e.preventDefault();
    var options = $.parseJSON($(this).attr('data-noty-options'));
    noty(options);
  });

  //tabs
  $('#myTab a:first').tab('show');
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });

  //tooltip
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    html: true
  });

  //popover
  $('[data-toggle="popover"]').popover({html: true, container: 'body'});

  // lightbox
  // delegate calls to data-toggle="lightbox"
  $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
    event.preventDefault();
    return $(this).ekkoLightbox({
      always_show_close: true
    });
  });

  // Div iconify/maximize/close
  $('.btn-close').click(function (e) {
    e.preventDefault();
    $(this).parent().parent().parent().fadeOut();
  });
  $('.btn-minimize').click(function (e) {
    e.preventDefault();
    var $target = $(this).parent().parent().next('.box-content');
    if ($target.is(':visible'))
      $('i', $(this)).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    else
      $('i', $(this)).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    $target.slideToggle();
  });

  // Help button to use modal to show message
  $('body').on('click', ".btn-help", function (e) {
    e.preventDefault();
    var helpText = $(this).attr('data-help');
    if (!helpText) {
      helpText = $(this).attr('data-content');
    }
    var helpTitle = $(this).text().trim();
    if (!helpTitle) {
      helpTitle = 'Help';
    }
    bootbox.dialog({
      message: helpText,
      title: helpTitle,
      onEscape: function () {
        $(this).modal('hide');
      },
      buttons: {
        success: {
          label: "OK"
        }
      }
    });
  });

  // My x-edit interface, with checkbox defined.
  // Assumes that the vars xeditHandler and xparams are defined in the global scope.
  if (typeof xeditHandler !== 'undefined' && typeof xparams !== 'undefined') {
    $('.xedit').editable({
      url: xeditHandler,
      validate: function (value) {
        var validator = $(this).attr('data-validator');
        if (validator) {
          return validate[validator](value);
        }
      },
      params: function (params) {
        var validator = $(this).attr('data-validator');
        if (validator)
          params.validator = validator;
        $.each(xparams, function (key, value) {
          params[key] = value;
        });
        return params;
      }
    });
    var activeText = '<i class="glyphicon glyphicon-ok icon-white"></i> Yes';
    $('.xedit-checkbox').width(50).editable({
      url: xeditHandler,
      type: 'checklist',
      source: {'1': 'Yes'},
      emptytext: ' <i class="glyphicon glyphicon-remove icon-white"></i>&nbsp; No ',
      emptyclass: 'btn-danger',
      success: function (response, newValue) {
        if (typeof checkBoxChanged === 'function') {
          checkBoxChanged(newValue);
        }
        if (newValue === "0" || newValue[0] === "0") {
          $(this).removeClass('btn-success').addClass('btn-danger');
        }
        if (newValue === "1" || newValue[0] === "1") {
          $(this).removeClass('btn-danger').addClass('btn-success');
        }
      },
      display: function (value, sourceData) {
        if (value == 1) { // Needs to be autocasting ==, not ===
          $(this).html(activeText);
          $(this).width(50);
        }
        else {
          $(this).html(''); // Don't know why this works!
          $(this).width(50);
        }
      },
      params: function (params) {
        $.each(xparams, function (key, value) {
          params[key] = value;
        });
        return params;
      },
      error: function (a) {
        $("#alertErrorText").html(a.responseText);
        $(".alert").show();
      }
    });
  }
  $('.xedit-new').editable({
    url: 'ajax/success.php',
    validate: function (value) {
      var validator = $(this).attr('data-validator');
      if (validator) {
        return validate[validator](value);
      }
    },
    params: function (params) {
      var validator = $(this).attr('data-validator');
      if (validator)
        params.validator = validator;
      return params;
    }
  });
  $('.xedit-checkbox-new').editable('option', 'url', 'ajax/success.php');

  $('.colorpicker').colorpicker();

//Add Hover effect to menus
  $('ul.nav li.dropdown').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
  }, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
  });

  $('body').on('click', ".goPro", function (e) {
    e.preventDefault();
    var product = $(this).attr('data-product');
    if (!product) {
      product = 'google-adsense';
    }
    var url = 'http://buy.thulasidas.com/' + product;
    var title = "Get the Pro version";
    var w = 1024;
    var h = 728;
    return ezPopUp(url, title, w, h);
  });

  $('.popup').click(function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var title = "Support Ticket";
    var w = 1024;
    var h = 728;
    return ezPopUp(url, title, w, h);
  });

  $('.popup-tall, .popup-long').click(function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var title = "Support Ticket";
    var w = 1000;
    var h = 1024;
    return ezPopUp(url, title, w, h);
  });

  if (inIframe()) {
    $("#standAloneMode").show();
    $('body').find('a').not("#standAloneMode, .popup").each(function () {
      var href = $(this).attr('href');
      if (href) {
        href += (href.match(/\?/) ? '&' : '?') + 'inframe';
        $(this).attr('href', href);
      }
    });
  }
  else {
    $("#standAloneMode").fadeOut();
  }

}

function isInWP() {
  var hash, inWP = false;
  var q = document.URL.split('?')[1];
  if (q != undefined) {
    q = q.split('&');
    for (var i = 0; i < q.length; i++) {
      hash = q[i].split('=');
      if (hash[0] === 'wp') {
        return true;
      }
    }
  }
  return false;
}

function inIframe() {
  try {
    return window.self !== window.top;
  } catch (e) {
    return true;
  }
}

function flashMsg(msg, kind, noflash) {
  var id = "#alert" + kind + "Text";
  $(id).html('<strong>' + kind + '</strong>: ' + msg);
  if (typeof (noflash) === 'undefined') {
    $(id).parent().slideDown().delay(6000).slideUp();
  }
  else {
    $(id).parent().slideDown();
  }
  return $(id);
}

function flashError(error) {
  return flashMsg(error, 'Error');
}

function showError(error) {
  return flashMsg(error, 'Error', true);
}

function flashWarning(warning) {
  return flashMsg(warning, 'Warning');
}

function showWarning(warning) {
  return flashMsg(warning, 'Warning', true);
}

function flashSuccess(message) {
  return flashMsg(message, 'Success');
}

function showSuccess(message) {
  return flashMsg(message, 'Success', true);
}

function flashInfo(message) {
  return flashMsg(message, 'Info');
}

function showInfo(message) {
  return flashMsg(message, 'Info', true);
}

$(".close").click(function () {
  $(this).parent().slideUp();
});


function containerSelect(id) {
  containerUnselect();
  if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(id);
    range.select();
  }
  else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(id);
    window.getSelection().addRange(range);
  }
}

function containerUnselect() {
  if (document.selection) {
    document.selection.empty();
  }
  else if (window.getSelection) {
    window.getSelection().removeAllRanges();
  }
}

function validate_email(s) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!re.test(s)) {
    return "Bad email address";
  }
}

function validate_notNull(s) {
  if ($.trim(s) == '' || s === 'Empty') {
    return "Null value not allowed";
  }
}

function validate_number(s) {
  if (!jQuery.isNumeric(s)) {
    return "Need a number here";
  }
}

function validate_alnum(s) {
  var ss = s.replace('-', '').replace('_', '');
  var re = /^[a-zA-Z0-9]+$/;
  if (!re.test(ss) || s === 'Empty') {
    return "Please use only letters, numbers, - and _";
  }
}

function validate_url(s) {
  var re = /^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
  if (!re.test(s)) {
    return "Bad URL";
  }
}

var validate = {
  email: function (s) {
    return validate_email(s);
  },
  notNull: function (s) {
    return validate_notNull(s);
  },
  number: function (s) {
    return validate_number(s);
  },
  alnum: function (s) {
    return validate_alnum(s);
  },
  url: function (s) {
    return validate_url(s);
  }
};
