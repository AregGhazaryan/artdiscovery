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

// Vue.component('posts', require('./components/Post.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// const app = new Vue({
//     el: '#app',
// });

import {
  Calendar
} from './@fullcalendar/core';
import dayGridPlugin from './@fullcalendar/daygrid';
import ruLocale from './@fullcalendar/core/locales/ru';
import hyLocale from './@fullcalendar/core/locales/hy';
import './@fullcalendar/core/main.css';
import './@fullcalendar/daygrid/main.css';
// import './@fullcalendar/timegrid/main.css';
// import './@fullcalendar/list/main.css';

var gEventId = 0;
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var lang = document.getElementsByTagName('html')[0].getAttribute('lang');
  if(lang == 'hy'){
    var language = hyLocale;
  }else if(lang == 'ru'){
    var language = ruLocale;
  }else{
    var language = 'en';
  }
  var calendar = new Calendar(calendarEl, {
    displayEventTime: false,
    eventColor: '#004fff',
    locales: [ ruLocale, hyLocale],
    locale: language,
    plugins: [dayGridPlugin],
    events: '/events/get',
    eventRender: function(info) {
    info.el.className += " " + info.event.id + " ";
    },
    eventClick: function(info) {
      gEventId = info.event.id;
      $('.fc-event-container a').css('background-color', '#004fff');
      $('.'+ info.event.id).css("background-color", "#00da4a");
      var start = info.event.start;
      var end = info.event.end;

      var st_date = `${
      (start.getMonth()+1).toString().padStart(2, '0')}/${
      start.getDate().toString().padStart(2, '0')}/${
      start.getFullYear().toString().padStart(4, '0')} ${
      start.getHours().toString().padStart(2, '0')}:${
      start.getMinutes().toString().padStart(2, '0')}:${
      start.getSeconds().toString().padStart(2, '0')}`;

      var end_date = `${
      (end.getMonth()+1).toString().padStart(2, '0')}/${
      end.getDate().toString().padStart(2, '0')}/${
      end.getFullYear().toString().padStart(4, '0')} ${
      end.getHours().toString().padStart(2, '0')}:${
      end.getMinutes().toString().padStart(2, '0')}:${
      end.getSeconds().toString().padStart(2, '0')}`;


      // $(info.el).css('background-color', '#00da4a');
      $('#info-container').empty();
      var html = '<div class="card shadow-sm">';
      if (info.event._def.extendedProps.image !== null) {
        html += '<img class="card-img-top" src="/storage/event_images/' + info.event._def.extendedProps.image + '">';
      }
      html += '<div class="card-body d-flex flex-column justify-content-between"><h4 class="card-title">' + info.event.title +
        '</h4><h5 class="d-flex justify-content-between">' + info.event._def.extendedProps.location + '<small>' +
        st_date + ' - ' + end_date + '</small></h5><div class="card-text">' +
        info.event._def.extendedProps.description + '</div></div></div>';
      $('#info-container').append(html);
    }

  });

  calendar.render();
  $('.fc-next-button, .fc-prev-button').click(function(){
    console.log(gEventId);
        $('.'+ gEventId).css("background-color", "#00da4a");
  });
});

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

class EventUploadAdapter {
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

    xhr.open('POST', '/uploadEventImg', true);
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

function EventUploadAdapterPlugin(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
    // Configure the URL to the upload script in your back-end here!
    return new EventUploadAdapter(loader);
  };
}

let eventeditor;
ClassicEditor
  .create(document.querySelector('#event-description'), {
    extraPlugins: [EventUploadAdapterPlugin],
    image: {
      resizeUnit: 'px',
      toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],
      styles: [
        // This option is equal to a situation where no style is applied.
        'full',

        // This represents an image aligned to the left.
        'alignLeft',

        // This represents an image aligned to the right.
        'alignRight'
      ]
    },
    simpleUpload: {
      uploadUrl: '/uploadEventImg',

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }
  })
  .then(newEditor => {
    eventeditor = newEditor;
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
      toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],
      styles: [
        // This option is equal to a situation where no style is applied.
        'full',

        // This represents an image aligned to the left.
        'alignLeft',

        // This represents an image aligned to the right.
        'alignRight'
      ]
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
      var html = '<div class="card post-card shadow-sm mt-2"><div class="card-header bg-white p-3 post-by">';
      html += '<a href="/profile/' + response.user['id'] + '"><img class="post-by-image mr-2" src="storage/profile_images/' + response.user['avatar'] + '" />' +
        response.user['first_name'] + ' ' + response.user['last_name'] +
        '</a><div class="dropdown post-options float-right"><a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item waves-light" href="/post/' +
        response.post['id'] + '/edit">' + edtext + '</a><a class="dropdown-item waves-light delete-post" data-id="' + response.post['id'] + '">' + deltext + '</a></div></div></div><div class="card-header bg-white p-3 align-middle post-title">' + response.post['title'] +
        '</div><div class="card-body">' + response.post['content'] + '</div><div class="card-footer p-2"><div class="comments-section"><div class="input-group"><input type="text" name="comment_body" class="form-control" /><button data-post="' + response.post['id'] + '" type="button" class="btn btn-primary add-comment-button submit-comment">' + trans('comments.add') + '</button></div><hr /><div class="comments-wrapper"><div class="comments-placeholder"></div></div></div>';

      $('#new-added').prepend(html);
      editor.setData('');
      $('#post-title').val('');
      $('.submit-loading').fadeOut();
    }).fail(function(xhr, status, error) {
      $('.submit-loading').fadeOut();
    });

});

// Delete post
$(document).on('click', '.delete-post', function(event) {
  var images = [];
  var container = $(this).closest('.post-card');
  console.log(container);
  var id = $(this).data('id');
  $(this).parents('.card').find('.post-content').find('img').each(function() {
    images.push(this.src);
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "/post/" + id + "/delete",
    data: {
      images: images,
      id: id,
    },
    type: 'DELETE',
    success: function(result) {
      console.log(result);
      container.remove();
    }
  });
  // $('.submit-loading').fadeIn().css("display", "inline-block");
});

// Add Comment
$(document).on('click', '.submit-comment', function(event) {
  var body_input = $(this).prev('input');
  var comment_body = $(this).prev('input').val();
  // if(comment_body == ''){
  //   body_input.addClass('is-invalid');
  //   return;
  // }else{
  //   body_input.addClass('is-valid');
  // }
  var post = $(this).data('post');
  var edtext = trans('posts.edit');
  var reptext = trans('comments.reply');
  var deltext = trans('posts.delete');
  var comment_placeholder = $(this).parent().siblings().find('.comments-placeholder');
  if (comment_placeholder.parent().not('.show')) {
    comment_placeholder.parent().addClass('show');
  }
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
      var html = '<div class="comment-wrapper"><div class="bg-white comment rounded p-2 shadow-sm"><div class="comment-header mb-1"><a href="/profile/' +
        response[0].user['id'] + '"><img class="comment-by-image mr-2" src="storage/profile_images/' +
        response[0].user['avatar'] + '"/>' + response[0].user['fullname'] +
        '</a><div class="dropdown post-options float-right dropleft comment-dropdowns"><a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item waves-light delete-comment" data-id="' + response[0].comment['id'] + '">' + deltext + '</a></div></div></div><div class="comment-body">' +
        response[0].comment['body'] + '</div><div class="replies-wrapper text-right"><a data-toggle="collapse" href="#reply' +
        response[0].comment['id'] + '" class="ml-3" role="button">' + reptext + '</a><div class="collapse" id="reply' +
        response[0].comment['id'] + '"><div class="input-group"><input type="text" name="comment_body" class="form-control" class="form-control" /><button data-comment="' +
        response[0].comment['id'] + '" data-parent="true" data-post="' + post + '" type="submit" class="btn btn-primary add-comment-button submit-reply">' +
        reptext + '</button></div></div></div><div class="comment-footer text-right"><small class="text-muted">' +
        response[0].comment['created_at'] + '</small></div></div><div class="collapse replies-collapse" id="replies' + response[0].comment['id'] + '"></div></div>';
      body_input.val('');
      body_input.removeClass('is-invalid');
      // body_input.addClass('is-valid');
      comment_placeholder.prepend(html);
    }).fail(function(response) {
      // body_input.addClass('is-invalid');
      console.log(response);
      for (let index in response.errors) {
        console.log(response.errors[index])
        for (let error in repsponse.errors[index]) {
          console.log(response.errors[index][error])
          body_input.parents('.comment').append(response.errors[index][error]);
        }
      }
    });
});

// Add Reply

$(document).on('click', '.submit-reply', function(event) {
  var post_id = $(this).data('post');
  var comment_id = $(this).data('comment');
  var body_input = $(this).prev('input');
  var comment_body = $(this).prev('input').val();
  let edtext = trans('posts.edit');
  let deltext = trans('posts.delete');
  let reptext = trans('comments.reply');
  // if(comment_body == ''){
  //   body_input.addClass('is-invalid');
  //   return;
  // }else{
  //   body_input.addClass('is-valid');
  // }
  if ($(this).data('parent')) {
    // comment_placeholder = $(this).closest('.replies-collapse');
    // if(comment_placeholder == null){
    var comment_placeholder = $(this).parents('.comment-wrapper').find('.replies-collapse');
    // }
  } else {
    var comment_placeholder = $(this).closest('.comments-wrapper');
  }
  if (comment_placeholder.not('.show')) {
    comment_placeholder.addClass('show');
  }
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.post("/reply/store", {
      post_id: post_id,
      comment_id: comment_id,
      comment_body: comment_body,
    })
    .done(function(response) {
      console.log(response);
      var html = '<div class="comment comment-reply shadow-sm p-2"><div class="comment-header mb-1"><a href="/profile/' + response.user['id'] +
        '"><img class="comment-by-image mr-2" src="storage/profile_images/' + response.user['avatar'] + '" />' +
        response.user['fullname'] + '</a><div class="dropdown post-options float-right dropleft comment-dropdowns"><a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item waves-light delete-comment" data-id="' +
        response.comment['id'] + '">' + deltext + '</a></div></div></div><div class="comment-body">' + response.comment['body'] + '</div><div class="replies-wrapper text-right"><a data-toggle="collapse" href="#reply' +
        response.comment['id'] + '" role="button">' + reptext + '</a><div class="collapse" id="reply' +
        response.comment['id'] + '"><div class="input-group"><input type="text" name="comment_body" class="form-control" class="form-control" /><button data-comment="' +
        response.comment['id'] + '" data-post="' + post_id + '" type="submit" class="btn btn-primary add-comment-button submit-reply" data-parent="true">' + reptext +
        '</button></div></div></div><div class="comment-footer text-right"><small class="text-muted">' +
        response.comment['created_at'] + '</small></div></div>';
      comment_placeholder.append(html);

      body_input.val('');
      body_input.removeClass('is-invalid');
      body_input.addClass('is-valid');
    }).fail(function(response) {
      body_input.addClass('is-invalid');
      console.log(response);
    });
});


// Delete Comment

$(document).on('click', '.delete-comment', function(event) {
  var comment = $(this).parents('.comment');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: '/comment/' + $(this).data('id'),
    type: 'DELETE',
    success: function(result) {
      comment.remove();
      console.log(result);
    }
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


$('.comments-collapse ').each(function() {
  id = genId(5);
  $(this).children('.collapse').attr('id', id);
  $(this).children('a').attr('href', '#' + id);
});
// End of video scrollers




$('.page-loader').fadeOut('slow');



$(function() {
  $('[data-toggle="tooltip"]').tooltip()
})

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

Waves.attach('button', 'waves-light');



// Find the element that causes the body to overflow
