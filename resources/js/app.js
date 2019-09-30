/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./@ckeditor/ckeditor5-build-classic/build/ckeditor.js');

// import Image from './@ckeditor/ckeditor5-image/src/image';
// import ImageToolbar from './@ckeditor/ckeditor5-image/src/imagetoolbar';
// import ImageCaption from './@ckeditor/ckeditor5-image/src/imagecaption';
// import ImageStyle from './@ckeditor/ckeditor5-image/src/imagestyle';

class MyUploadAdapter {
  constructor(loader) {
    this.loader = loader;
  }

  upload() {
    return this.loader.file
      .then(file => new Promise((resolve, reject) => {
        this._initRequest();
        this._initListeners(resolve, reject, file);
        this._sendRequest(file);
      }));
  }

  abort() {
    if (this.xhr) {
      this.xhr.abort();
    }
  }

  _initRequest() {
    const xhr = this.xhr = new XMLHttpRequest();

    xhr.open('POST', '/uploadImg', true);
    xhr.responseType = 'json';
  }

  _initListeners(resolve, reject, file) {
    const xhr = this.xhr;
    const loader = this.loader;
    const genericErrorText = `Couldn't upload file: ${ file.name }.`;

    xhr.addEventListener('error', () => reject(genericErrorText));
    xhr.addEventListener('abort', () => reject());
    xhr.addEventListener('load', () => {
      const response = xhr.response;
      if (!response || response.error) {
        return reject(response && response.error ? response.error.message : genericErrorText);
      }
      resolve({
        default: response.url
      });
    });

    if (xhr.upload) {
      xhr.upload.addEventListener('progress', evt => {
        if (evt.lengthComputable) {
          loader.uploadTotal = evt.total;
          loader.uploaded = evt.loaded;
        }
      });
    }
  }

  _sendRequest(file) {
    const data = new FormData();
    data.append('upload', file);
    this.xhr.send(data);
  }
}

// ...

function MyCustomUploadAdapterPlugin(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
    // Configure the URL to the upload script in your back-end here!
    return new MyUploadAdapter(loader);
  };
}



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


$(window).scroll(function() {
  if ($(this).scrollTop()) {
    $('#scroll-to-top').fadeIn();
  } else {
    $('#scroll-to-top').fadeOut();
  }
});

$("#scroll-to-top").click(function() {
  $("html, body").clearQueue();
  $("html, body").animate({
    scrollTop: 0
  }, 1000);
});


var allEditors = document.querySelectorAll('.ckeditor');
for (var i = 0; i < allEditors.length; ++i) {

  ClassicEditor.create(allEditors[i], {
    extraPlugins: [MyCustomUploadAdapterPlugin],
    image: {
      resizeUnit: 'px',
      toolbar: [ 'imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:side' ]
    },
    simpleUpload: {
      uploadUrl: '/uploadImg',

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }
  });
}

// Video scrollers

const slider = document.querySelectorAll('.video-body');
var isOnDiv = false;

let isDown = false;
let startX;
let scrollLeft;

slider.forEach(function(el) {
  el.addEventListener('mousedown', (e) => {
    isDown = true;
    el.classList.add('active');
    startX = e.pageX - el.offsetLeft;
    scrollLeft = el.scrollLeft;
  });
  el.addEventListener('mouseleave', () => {
    isDown = false;
    el.classList.remove('active');
  });
  el.addEventListener('mouseup', () => {
    isDown = false;
    el.classList.remove('active');
  });
  el.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - el.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    el.scrollLeft = scrollLeft - walk;
  });
});



$('.scroll-right-button').click(function() {
  event.preventDefault();
  $(this).siblings('.video-body').clearQueue();
  $(this).siblings('.video-body').animate({
    scrollLeft: "+=300px"
  }, "slow");
});

$('.scroll-left-button').click(function() {
  event.preventDefault();
  $(this).siblings('.video-body').clearQueue();
  $(this).siblings('.video-body').animate({
    scrollLeft: "-=300px"
  }, "slow");
});


// End of video scrollers
