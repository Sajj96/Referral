'use strict';
$(function () {
    $('#aniimated-thumbnials').lightGallery({
        autoplay: true,
        thumbnail: true,
        selector: 'a',
        extraProps: ['whatsappTitle'],
        additionalShareOptions: [
            {
                // Selector for the anchor tag inside share list item
                selector: '.lg-share-whatsapp',
    
                // HTML to be appended to the share dropdown menu
                dropdownHTML:
                    '<li class="lg-share-item-whatsapp"><a class="lg-share-whatsapp" target="_blank"><svg class="lg-whatsapp">...</svg><span class="lg-dropdown-text">Whatsapp</span></a></li>',
    
                // Construct url
                generateLink: (galleryItem) => {
                    const url = encodeURIComponent(window.location.href);
    
                    // The prop data-whatsapp-title is converted to whatsappTitle and added to the gallery item
                    const title = galleryItem.whatsappTitle;
                    const whatsappShareLink = `//web.whatsapp.com/send?text=${title}|${url}`;
                    return whatsappShareLink;
                },
            },
        ],
    });
});