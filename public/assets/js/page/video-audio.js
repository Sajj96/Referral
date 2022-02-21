"use strict";

$(function () {
  $('#aniimated-videos').lightGallery({
    // plugins: [lgVideo],
    videojs: true,
    selector: 'a',
    videojsOptions: {
      muted: true
    }
  });

  // var myPlayer = videojs('my-video', {}, function () {
  //   this.posterImage.off(['click', 'tap']);
  // });

  // myPlayer.on('play', () => {
  //   myPlayer.play();
  //   var user = $('.section').attr('data-user');
  //   console.log(myPlayer.duration());
  // });

  // myPlayer.on('pause', () => {
  //   myPlayer.paused();
  //   console.log("Paused");
  //   console.log(myPlayer.remainingTime());
  //   console.log(myPlayer.currentTime());
  // });
});
