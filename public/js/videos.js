jQuery(document).ready(function () {
  jQuery('body').on('contextmenu', 'video', function () {
    return false;
  });

  $('.subsection-picker').on('click', function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var text = $(this).text();
    $(this).parent().siblings('.dropdown-toggle').text(text);
    var container = $(this).parents('.section-container').find('.section-body');
    var add = container.find('.card-video-button-wrapper').first().children('.btn-orange').text();
    var buy = container.find('.card-video-button-wrapper').first().children('.btn-success').text();

    container.empty();
    container.parents('.section-container').children('.section-headline').children('.spinner-grow').fadeIn('slow');
    $.post("/getVideos", {
      section: $(this).data('section'),
      subsection: $(this).data('subsection')
    }).done(function (data) {
      html = '';
      for (let index in data) {
        html += '<div class="video-card card m-3" style="width: 18rem;">' + data[index].video +
          '<div class="card-body p-2"><h5 class="card-title m-0">' + data[index].title +
          '</h5><div class="text-muted mb-1"><small>' + data[index].start_date;
        if (data[index].end_date !== null) {
          html += ' - ' + data[index].end_date;
        }
        html += '</small></div><div class="d-flex justify-content-between pt-2 card-video-button-wrapper"><button class="btn-sm btn btn-orange"><i class="fas fa-cart-plus mr-2"></i>' +
          add + '</button><a href="#" class="btn btn-sm btn-success"><i class="fas fa-money-bill mr-2"></i>' +
          buy + '</a></div></div></div>';
      }
      container.parents('.section-container').children('.section-headline').children('.spinner-grow').fadeOut('slow');
      container.append(html);
    });
    
  });
});

// $(document).ready(function() {
//     $(".playback").on("timeupdate", function(event) {
//         console.log('sjgdroigje');
//         onTrackedVideoFrame(this.id, this.currentTime, this.duration);
//     });
// });

// function onTrackedVideoFrame(id, currentTime, duration, event) {
//     console.log(id);
//     if (currentTime > 60) {
//         let parent = $('#' + id).parent();
//         $('#' + id).remove();
//         parent.prepend('<img class="card-img-top" src="' + assets + '">');
//     }
// }
