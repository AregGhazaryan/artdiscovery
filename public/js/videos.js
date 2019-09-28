jQuery(document).ready(function() {
  jQuery('body').on('contextmenu', 'video', function() {
    return false;
  });

  $('.subsection-picker').on('click', function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var text = $(this).text();
    $(this).parent().siblings('.dropdown-toggle').text(text);
    var container = $(this).parents('.section-container').find('.section-body');
    var add = container.find('.card-video-button-wrapper').first().children('.btn-orange').text();
    var buy = container.find('.buy-btn').first().text();
    var info = container.find('.card-video-button-wrapper').first().children('.btn-info').text();
    var close = container.find('.close-btn').first().text();

    container.empty();
    container.parents('.section-container').children('.section-headline').children('.spinner-grow').fadeIn('slow');
    if($(this).data('name')){
      $(this).closest('.section-headline').children('.title').text($(this).data('name'));
    }else{
      $(this).closest('.section-headline').children('.title').text(text);
    }
    $.post("/getVideos", {
      section: $(this).data('section'),
      subsection: $(this).data('subsection')
    }).done(function(data) {
      html = '';
      for (let index in data) {
        html += '<div class="video-card card m-3" style="width: 18rem;"><div class="h-100 buy-btn-wrapper"><a href="#" class="btn btn-success buy-btn"><i class="fas fa-unlock mr-2"></i>' + buy + '</a></div>' +
          '<div class="card-body p-2"><h5 class="card-title m-0">' + data[index].title +
          '</h5><div class="text-muted mb-1"><small>' + data[index].start_date;
        if (data[index].end_date !== null) {
          html += ' - ' + data[index].end_date;
        }
        html += ' | <i class="fas fa-eye"></i> ' + data[index].views + '</small><span class="float-right font-weight-bold text-dark">' + data[index].price + data[index].currency.symbol + '</span></div><div class="d-flex justify-content-between pt-2 card-video-button-wrapper"><button class="btn-sm btn btn-orange"><i class="fas fa-cart-plus mr-2"></i>' +
          add + '</button><a href="#" class="btn btn-info buy-btn text-white" data-toggle="modal" data-target="#m' +
          data[index].id + '"><i class="fas fa-info-circle mr-1"></i>' + info + '</a></div></div></div>';
        html += '<div class="modal fade" id="m' + data[index].id + '" tabindex="-1" role="dialog" aria-labelledby="Video info" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">' + data[index].title + '</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">' + data[index].description + '</div><div class="modal-footer"><button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">' + close + '</button></div></div></div></div>';
      }
      container.parents('.section-container').children('.section-headline').children('.spinner-grow').fadeOut('slow');
      container.append(html);
      Waves.attach('.btn', ['waves-effect']);
    });

  });
});

// $(document).ready(function() {
//     $(".playback").on("timeupdate", function(event) {
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
