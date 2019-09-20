$(document).ready(function() {
    $(".timeline").each(function(index) {

        var id = $(this).data('sectionId');
        var subsection = $(this).data('subSectionId');

        var container = document.getElementById($(this).attr('id'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/getVideos',
            data: {
                id : id,
                subsection_id: subsection,
            },
            success: function(response) {
                console.log(response);
                sanitize = [];
                lang = $('html')[0].lang;
                for (let index in response) {
                    if (lang === 'hy') {
                        content = response[index].title_hy;
                    } else if (lang === 'en') {
                        content = response[index].title_en;
                    } else {
                        content = response[index].title_ru;
                    }
                    // console.log();
                    let start_date = response[index].start_date;
                    let end_date = response[index].end_date;
                    if (response[index].start_date.length === 4) {
                        var parse_start = new Date(start_date, 0, 0);
                    } else {
                        var parse_start = new Date(start_date);
                    }
                    if (response[index].end_date === null) {
                        var parse_end = null;
                    } else if (response[index].end_date.length === 4) {
                        var parse_end = new Date(end_date, 0, 0);
                    } else {
                        var parse_end = new Date(end_date);
                    }
                    if (parse_end === null) {
                        sanitize.push({
                            id: response[index].id,
                            content: content,
                            start: parse_start
                        });
                    } else {
                        sanitize.push({
                            id: response[index].id,
                            content: content,
                            start: parse_start,
                            end: parse_end
                        });
                    }
                }
                console.log(sanitize);
                items = new vis.DataSet(sanitize);
                var options = {
                    zoomMin: 0
                };
                timeline = new vis.Timeline(container, items, options);
                timeline.on('click', function(e) {
                    if (e.item !== null) {
                        $.ajax({
                            type: 'POST',
                            url: '/getVideo',
                            data: {
                                id: e.item,
                            },
                            success: function(response) {
                                if (lang === 'hy') {
                                    title = response.title_hy;
                                    description = response.description_hy;
                                } else if (lang === 'en') {
                                    title = response.title_en;
                                    description = response.description_en;
                                } else {
                                    title = response.title_ru;
                                    description = response.description_ru;
                                }
                                $('.modal-content').empty();
                                $('.modal-content').append('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"></div>');
                                $('.modal-header').prepend('<h4 class="modal-title">' + title + '</h4>');
                                $('.modal-body').append('<video class="playback" id="playback' + response.id +
                                    '" controls controlsList="nodownload" oncontextmenu="return false;"><source class="source" src="' + folder + '/' + response.video + '"></video><hr>');
                                $('.modal-body').append(description);
                                $(".playback").on("timeupdate", function(event) {
                                    onTrackedVideoFrame(this.id, this.currentTime, this.duration);
                                });
                            }
                        });
                        var options = {
                            show: true,
                            keyboard: true,
                            backdrop: true
                        }
                        $('#item-modal').modal(options)
                    }
                });
            }
        });

    });
});
