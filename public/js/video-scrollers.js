    const slider = document.querySelector('.video-body');
    var isOnDiv = false;

    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
    });
    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
    });
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        slider.scrollLeft = scrollLeft - walk;
    });


    $('#scroll-right-button').click(function() {
        event.preventDefault();
        $(this).siblings('.video-body').clearQueue();
        $(this).siblings('.video-body').animate({
            scrollLeft: "+=300px"
        }, "slow");
    });

    $('#scroll-left-button').click(function() {
        event.preventDefault();
        $(this).siblings('.video-body').clearQueue();
        $(this).siblings('.video-body').animate({
            scrollLeft: "-=300px"
        }, "slow");
    });
