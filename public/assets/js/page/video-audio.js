"use strict";

$(function () {

    var sync1 = $(".slider");
    var sync2 = $(".navigation-thumbs");

    var thumbnailItemClass = ".owl-item";

    var slides = sync1
        .owlCarousel({
            video: true,
            startPosition: 0,
            items: 1,
            loop: false,
            margin: 10,
            autoplay: false,
            autoplayTimeout: 6000,
            autoplayHoverPause: false,
            nav: false,
            dots: false,
        })
        .on("changed.owl.carousel", syncPosition);

    function syncPosition(el) {
        var $owl_slider = $(this).data("owl.carousel");
        var loop = $owl_slider.options.loop;

        if (loop) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
        } else {
            var current = el.item.index;
        }

        var owl_thumbnail = sync2.data("owl.carousel");
        var itemClass = "." + owl_thumbnail.options.itemClass;

        var thumbnailCurrentItem = sync2
            .find(itemClass)
            .removeClass("synced")
            .eq(current);

        thumbnailCurrentItem.addClass("synced");

        if (!thumbnailCurrentItem.hasClass("active")) {
            var duration = 300;
            sync2.trigger("to.owl.carousel", [current, duration, true]);
        }
    }
    var thumbs = sync2
        .owlCarousel({
            startPosition: 0,
            items: 4,
            loop: false,
            margin: 10,
            autoplay: false,
            nav: false,
            dots: false,
            onInitialized: function (e) {
                var thumbnailCurrentItem = $(e.target)
                    .find(thumbnailItemClass)
                    .eq(this._current);
                thumbnailCurrentItem.addClass("synced");
            },
        })
        .on("click", thumbnailItemClass, function (e) {
            e.preventDefault();
            var duration = 300;
            var itemIndex = $(e.target).parents(thumbnailItemClass).index();
            sync1.trigger("to.owl.carousel", [itemIndex, duration, true]);
        })
        .on("changed.owl.carousel", function (el) {
            var number = el.item.index;
            var $owl_slider = sync1.data("owl.carousel");
            $owl_slider.to(number, 100, true);
        });

    $(".videos").each(function (x, i) {
        var id = $(this).attr("id");
        var video_id = $(this).data("id");
        var user_id = $(".section").attr("data-user");

        var myPlayer = videojs(id, {}, function () {
            this.posterImage.off(["click", "tap"]);
        });

        myPlayer.on("play", () => {
           myPlayer.play();
       });
        
       myPlayer.on("pause", () => {
           myPlayer.pause();
       });

       
        myPlayer.on("timeupdate", () => {
        
            var remainingTime = myPlayer.remainingTime();
            var halfDuration = myPlayer.duration() / 2;
            var currentTime = myPlayer.currentTime();

                if (currentTime >= halfDuration) {
                myPlayer.pause();
                $.ajax({
                    url: url3,
                    method: "GET",
                    data: {
                        video_id: video_id,
                        user_id: user_id
                    },
                    success: function (count) {
                      var rows = count;
                      if(rows > 0) {
                        $("#exampleModal2").modal("show");
                      } else {
                          $.ajax({
                                url: url2,
                                method: "POST",
                                data: {
                                    _token: document
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute("content"),
                                    video_id: video_id,
                                    user_id: user_id
                                },
                                success: function (resp) {
                                    if(rows == 0) {
                                          $.ajax({
                                            url: url1,
                                            method: "POST",
                                            data: {
                                                _token: document
                                                    .querySelector('meta[name="csrf-token"]')
                                                    .getAttribute("content"),
                                                user_id: user_id,
                                                video_id:video_id,
                                                type: "video",
                                                amount: 250
                                            },
                                            success: function (response) {
                                              $("#exampleModal").modal("show");
                                            },
                                        });
                                    }
                                },
                            });
                      }
                    },
                });
            }
        });

        myPlayer.on("ended", () => {
            console.log(myPlayer.currentTime());
        });
    });
});

jQuery(function($) {
    $("#exampleModal").on("hidden.bs.modal", function (e) {
         e.preventDefault();
        window.location.href = url4;
        // location.reload();
    });
    
    $("#exampleModal2").on("hidden.bs.modal", function (e) {
         e.preventDefault();
        window.location.href = url4;
        // location.reload();
    });
});
