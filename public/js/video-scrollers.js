    const slider = document.querySelectorAll('.video-body');
    var isOnDiv = false;

    let isDown = false;
    let startX;
    let scrollLeft;

    slider.forEach(function (el) {
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



    $('.scroll-right-button').click(function () {
      event.preventDefault();
      $(this).siblings('.video-body').clearQueue();
      $(this).siblings('.video-body').animate({
        scrollLeft: "+=300px"
      }, "slow");
    });

    $('.scroll-left-button').click(function () {
      event.preventDefault();
      $(this).siblings('.video-body').clearQueue();
      $(this).siblings('.video-body').animate({
        scrollLeft: "-=300px"
      }, "slow");
    });
