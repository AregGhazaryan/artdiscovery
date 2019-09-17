jQuery(document).ready(function() {
    jQuery('body').on('contextmenu', 'video', function() {
        return false;
    });
});

$(document).ready(function() {
    $(".playback").on("timeupdate", function(event) {
        console.log('sjgdroigje');
        onTrackedVideoFrame(this.id, this.currentTime, this.duration);
    });
});

function onTrackedVideoFrame(id, currentTime, duration, event) {
    console.log(id);
    if (currentTime > 60) {
        let parent = $('#' + id).parent();
        $('#' + id).remove();
        parent.prepend('<img class="card-img-top" src="' + assets + '">');
    }
}
