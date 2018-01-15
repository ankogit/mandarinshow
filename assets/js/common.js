$(function() {







/*var slideout = new Slideout({
        'panel': document.getElementById('panel'),
        'menu': document.getElementById('menu'),
        'padding': 256,
        'tolerance': 7
      });
      document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
          slideout.toggle();
        });*/
	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};
/*
	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
*//*
	//Chrome Smooth Scroll
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};
*/
	$("img, a").on("dragstart", function(event) { event.preventDefault(); });
	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    panel.classList.toggle("active");
    if (panel.style.maxHeight){
  	  panel.style.maxHeight = null;
    } else {
  	  panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
});

$(window).load(function() {

	$(".loader_inner").fadeOut();
    $(".preloader").fadeOut();
	$(".loader").delay(400).fadeOut("slow");

    //Попап
        $(".popup").magnificPopup({type:"image"});
    $(".popup_content").magnificPopup({
        type:"inline",
        midClick: true
    });
    
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',

        overflowY: 'hidden',

        closeBtnInside: true,
        preloader: false,
        
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
    $('#image-popups').magnificPopup({
      delegate: 'a.ilink',
      type: 'image',
      removalDelay: 500, //delay removal by X to allow out-animation
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup 
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = this.st.el.attr('data-effect');
        }
      },
      closeOnContentClick: true,
      midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });
    //Кнопка "Наверх"
    //Документация:
    //http://api.jquery.com/scrolltop/
    //http://api.jquery.com/animate/
    $("#gotop").click(function () {
        $("body, html").animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    //Button next block in full page
    $(".scroll-btn").click(function () {
        $ .scrollify.next ();
        return false;
    });

    //masonry
    var $container = $(".masonry-container");
    $container.imagesLoaded(function () {
        $container.masonry({
            columnWidth: ".item",
            itemSelector: ".item"
        });
        $(".item").imagefill();
    });
    $(".gitem").imagefill();
    /*
    //Портфолио_просмотр
    $(".gall_item ").each(function(i) {
        $(this).find("a").attr("href", "#work_" + i);
        $(this).find(".podrt_descr").attr("id", "work_" + i);
    });
    //Портфолио_просмотр
    $(".portfolio_item").each(function(i) {
        $(this).find("a").attr("href", "#work_" + i);
        $(this).find(".podrt_descr").attr("id", "work_" + i);
    });
    //Портфолио_просмотр
    $(".item").each(function(i) {
        $(this).find("a").attr("href", "#work_" + i);
        $(this).find(".podrt_descr").attr("id", "work_" + i);
    });*/

if($(document).width() > 768) {
    $.scrollify({
                section : ".full-scroll",
                updateHash: false,
                scrollSpeed: 1000,
    });

    $.scrollify.update();
}
});

$(document).on('ready', function() {

    // ================================ //
    // Slideout Left Menu               //
    // ================================ //

    // Slideout Variable
    var slideoutLeft = new Slideout({
        'panel': document.getElementById('panel'),
        'menu': document.getElementById('menu'),
        'padding': 256,
        'tolerance': 70
    });

    // Toggle button
    $('#toggle').click(function() {
        slideoutLeft.toggle();
    });

    slideoutLeft.on('beforeopen', function() {
        document.querySelector('.fixed').classList.add('fixed-open-left');
        document.querySelector('.js-slideout-toggle').classList.add('on');
    });

    slideoutLeft.on('beforeclose', function() {
        document.querySelector('.fixed').classList.remove('fixed-open-left');
        document.querySelector('.js-slideout-toggle').classList.remove('on');
    });



      $(".single-item").slick({
        dots: true,
        adaptiveHeight: true,
                    
      });
    });

var theToggle = document.getElementById('toggle');

// based on Todd Motto functions
// https://toddmotto.com/labs/reusable-js/

// hasClass
function hasClass(elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
        elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
    var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
    var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0 ) {
            newClass = newClass.replace( " " + className + " " , " " );
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }
}

theToggle.onclick = function() {
   toggleClass(this, 'on');
   return false;
}
function submit_search() {
        post_query('esearch', 'search', 'search.userid');
    }