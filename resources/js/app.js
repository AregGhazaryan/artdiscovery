/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('art-section', require('./components/Section.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// const app = new Vue({
//     el: '#app',
// });


$(window).scroll(function () {
  if ($(this).scrollTop()) {
    $('#scroll-to-top').fadeIn();
  } else {
    $('#scroll-to-top').fadeOut();
  }
});

$("#scroll-to-top").click(function () {
  $("html, body").clearQueue();
  $("html, body").animate({
    scrollTop: 0
  }, 1000);
});


var allEditors = document.querySelectorAll('.ckeditor');
for (var i = 0; i < allEditors.length; ++i) {
  ClassicEditor.create(allEditors[i]);
}

! function (t) {
  "use strict";
  t("#sidebarToggle, #sidebarToggleTop").on("click", function (o) {
    t("body").toggleClass("sidebar-toggled"), t(".sidebar").toggleClass("toggled"), t(".sidebar").hasClass("toggled") && t(".sidebar .collapse").collapse("hide")
  }), t(window).resize(function () {
    t(window).width() < 768 && t(".sidebar .collapse").collapse("hide")
  }), t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function (o) {
    if (768 < t(window).width()) {
      var e = o.originalEvent,
        l = e.wheelDelta || -e.detail;
      this.scrollTop += 30 * (l < 0 ? 1 : -1), o.preventDefault()
    }
  }), t(document).on("scroll", function () {
    100 < t(this).scrollTop() ? t(".scroll-to-top").fadeIn() : t(".scroll-to-top").fadeOut()
  }), t(document).on("click", "a.scroll-to-top", function (o) {
    var e = t(this);
    t("html, body").stop().animate({
      scrollTop: t(e.attr("href")).offset().top
    }, 1e3, "easeInOutExpo"), o.preventDefault()
  })
}(jQuery);
