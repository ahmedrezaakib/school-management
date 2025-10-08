/* School Management UI polish (safe, non-breaking) */
$(function () {
  // 3.1) Keep OverlayScrollbars but tweak behavior
  if ($.fn.overlayScrollbars) {
    $('body').overlayScrollbars({ className: "os-theme-light", scrollbars: { autoHide: 'leave' } });
    $('.main-sidebar .sidebar').overlayScrollbars({ className: "os-theme-light", scrollbars: { autoHide: 'leave' } });
  }

  // 3.2) Active menu highlight based on current URL
  var here = window.location.pathname.replace(/\/+$/,'');
  $('.nav-sidebar a.nav-link').each(function(){
    var href = $(this).attr('href') || '';
    try {
      var path = new URL(href, window.location.origin).pathname.replace(/\/+$/,'');
      if (path && here.startsWith(path)) {
        $(this).addClass('active');
        $(this).closest('.has-treeview, .nav-item').addClass('menu-open');
      }
    } catch(e){}
  });

  // 3.3) Add a floating Dark Mode toggle (no HTML edits needed)
  var $toggle = $('<button/>', {
    class: 'btn btn-sm btn-primary',
    html: '<i class="fas fa-moon"></i>',
    css: {
      position:'fixed', right:'18px', bottom:'18px', zIndex:1050,
      borderRadius:'999px', width:'44px', height:'44px', boxShadow:'0 12px 32px rgba(2,6,23,.25)'
    },
    title:'Toggle Dark Mode'
  }).appendTo('body');

  function setDarkMode(on){
    $('body').toggleClass('dark-mode', !!on);
    localStorage.setItem('sm_dark', on ? '1':'0');
  }
  setDarkMode(localStorage.getItem('sm_dark')==='1');
  $toggle.on('click', function(){ setDarkMode(!$('body').hasClass('dark-mode')); });

  // 3.4) Soften navbar search UI
  $('.navbar-search-block .form-control-navbar').attr('placeholder','Search anything (students, classes, fees...)');

  // 3.5) Nice ripple on sidebar clicks (pure CSS class toggle)
  $('.nav-sidebar .nav-link').on('click', function(e){
    var $t = $(this);
    $t.addClass('animate__animated animate__pulse');
    setTimeout(()=> $t.removeClass('animate__animated animate__pulse'), 500);
  });
});
