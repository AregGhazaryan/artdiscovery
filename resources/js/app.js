/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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

// Start of TranslationServiceProvider
function trans(key, replace = {}) {
  let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

  for (var placeholder in replace) {
    translation = translation.replace(`:${placeholder}`, replace[placeholder]);
  }

  return translation;
}

function trans_choice(key, count = 1, replace = {}) {
  let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations).split('|');

  translation = count > 1 ? translation[1] : translation[0];

  for (var placeholder in replace) {
    translation = translation.replace(`:${placeholder}`, replace[placeholder]);
  }

  return translation;
}

//end of TranslationServiceProvider

require('./bootstrap');
require('./@ckeditor/ckeditor5-build-classic/build/ckeditor.js');
require('./gijgo.js');

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

class PostUploadAdapter {
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

    xhr.open('POST', '/uploadPostImg', true);
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

function PostUploadAdapterPlugin(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
    // Configure the URL to the upload script in your back-end here!
    return new PostUploadAdapter(loader);
  };
}



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
    },
    simpleUpload: {
      uploadUrl: '/uploadImg',

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }
  });
}

let editor;

ClassicEditor
  .create(document.querySelector('#editor'), {
    extraPlugins: [PostUploadAdapterPlugin],
    image: {
      resizeUnit: 'px',
    },
    simpleUpload: {
      uploadUrl: '/uploadPostImg',

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }
  })
  .then(newEditor => {
    editor = newEditor;
  });

$('.page-loader').fadeOut('slow');


// Add post
$(document).on('click', '#publish-post', function(event) {
  const editorData = editor.getData();
  let edtext = trans('posts.edit');
  let deltext = trans('posts.delete');
  $('#content').val(editorData);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.submit-loading').fadeIn().css("display", "inline-block");
  $.post("/post", {
      title: $('#post-title').val(),
      content: editorData
    })
    .done(function(response) {
      html = '<div class="card post-card shadow-sm mt-2"><div class="card-header bg-white p-3 post-by">';
      html += '<a href="/profile/' + response.user['id'] + '"><img class="post-by-image mr-2" src="storage/profile_images/' + response.user['avatar'] + '" />' +
        response.user['first_name'] + ' ' + response.user['last_name'] +
        '</a><div class="dropdown post-options float-right"><a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item waves-light" href="/post/' +
        response.post['id'] + '/edit">' + edtext + '</a><a class="dropdown-item waves-light" href="/post/' + response.post['id'] + '/delete' + '">' + deltext + '</a></div></div></div><div class="card-header bg-white p-3 align-middle post-title">' + response.post['title'] +
        '</div><div class="card-body">' + response.post['content'] + '</div><div class="card-footer p-2"><div class="comments-section"><div class="input-group"><input type="text" name="comment_body" class="form-control" /><button data-post="' + response.post['id'] + '" type="button" id="submit-comment" class="btn btn-primary add-comment-button">' +
        trans('comments.add') + '</button></div><hr /></div></div></div>';

      $('#new-added').prepend(html);
      editor.setData('');
      $('#post-title').val('');
      $('.submit-loading').fadeOut();
    }).fail(function(xhr, status, error) {
      $('.submit-loading').fadeOut();
    });

});

// Add Comment
$(document).on('click', '.submit-comment', function(event) {
  const editorData = editor.getData();
  body_input = $(this).prev('input');
  comment_body = $(this).prev('input').val();
  post = $(this).data('post');
  comment_placholder = $(this).parent().siblings().find('.comments-placeholder');
  console.log(comment_placholder);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.post("/comment", {
      comment_body: comment_body,
      post_id: post,
    })
    .done(function(response) {
      html = '<div class="bg-white comment rounded p-2"><div class="comment-header mb-1"><a href="/profile/' +
        response.user['id'] + '"><img class="comment-by-image mr-2" src="storage/profile_images/' +
        response.user['avatar'] + '"/>' + response.user['fullname'] + '</a></div><div class="comment-body">' +
        response.comment['body'] + '</div><div class="comment-footer text-right"><small class="text-muted">' +
        response.comment['created_at'] + '</small></div></div>';
      body_input.val('');
      comment_placholder.prepend(html);
    }).fail(function(xhr, status, error) {
      console.log(error);
    });

});


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

$('#datepicker').datepicker({
  uiLibrary: 'bootstrap4',
  format: 'yyyy/mm/dd'
});


$('.comments-collapse ').each(function(){
  id = genId(5);
  $(this).children('.collapse').attr('id', id);
  $(this).children('a').attr('href', '#'+id);
});
// End of video scrollers
