var config = {
    base_path: '/fn',
    site: 'http://localhost',
    profile_pic: '/fn/assets/images/uploads/profiles',
    post_pic: '/fn/media.php?hash='
};
if (!String.format) {
    String.format = function(format) {
        var args = Array.prototype.slice.call(arguments, 1);
        return format.replace(/{(\d+)}/g, function(match, number) {
            return typeof args[number] != 'undefined' ?
                args[number] :
                match;
        });
    };
}
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
var moments = (function($, document) {
    var evt = [
            // moment
            function($) {
                $('[data-toggle=moment]').each(function() {
                    var time = $(this).data('time');
                    $(this).attr('title', time)
                        .text(moment(time).fromNow());
                });
            },

            // refresh time every minute
            function($) {
                setInterval(function() {
                    $('[data-toggle=moment]').each(function() {
                        var time = $(this).data('time');
                        var m = moment(time).fromNow();
                        if (m != $(this).text()) {
                            $(this).attr('title', time)
                                .text(m);
                        }
                    });
                }, 60 * 1000);
            }
        ],
        initAll = function() {
            initEvt();
        },
        initEvt = function() {
            evt.forEach(function(e) {
                e($, document);
            });
        };

    return { init: initAll };

})(jQuery, document);

var footnote = (function($, document) {

    var evt = [

            function($) {
                $('[data-toggle=offcanvas]').click(function() {
                    $('.row-offcanvas').toggleClass('active');
                });
            },
            // show
            function($) {

                $('[data-options]').click(function(e) {
                    var $this = $(this);
                    var option = $this.data('options');
                    console.log($this.data('options'));
                    $('#' + option).removeClass('hide');
                    if ($this.data('callback')) {
                        var cb = $this.data('callback').split("|", 2);
                        var action = cb[0],
                            elem = cb[1];
                        if (action == "hide") {
                            $('#' + elem).removeClass('show').addClass('hide');
                        } else if (action == "show") {
                            $('#' + elem).removeClass('hide').addClass('show');
                        }
                    }
                    e.preventDefault();
                });

            },

            function($) {
                $('form#share-box').submit(function(e) {
                    var data = $(this).serialize();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: data,
                        // dataType:'text/HTML',
                        success: function(result) {
                            console.log(result);
                            $('.post-list').prepend(result);
                        }
                    });
                    e.preventDefault();
                });
            },

            // upload
            function($) {

                $('form#status-form').validator().on('submit', function(e) {
                    if (e.isDefaultPrevented()) {
                        var message = `
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong><br/>Please describe your experience and upload your image.
                        </div>
                        <hr>
                        `;
                        $('.post-list').prepend(message);
                        return;
                    }
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    var form = $(this);
                    console.log(formData);

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function(data) {
                            var message = `
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Thank you for posting!</strong><br/>Your post will be verified by the admin and will be shown to our news feed if approved.
                            </div>
                            <hr>
                            `;
                            $('.post-list').prepend(message);
                            $(".image-preview").addClass('hide');
                            $('#text').val('');
                            //form.reset();
                            moments.init();
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });

                });
                $('#post-image').on("change", function() {
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function() { // set image data as background of div

                            var img = '<div class="image">' +
                                '<img src="' + this.result + '" data-action="zoom"/>' +
                                '</div>';

                            $(".image-preview")
                                .html('')
                                .append(img)
                                .removeClass('hide');
                        }
                    }
                });

            },

            // like
            function($) {
                $(document).on('click', '[data-toggle=like]', function(e) {
                    e.preventDefault();
                    var post_id = $(this).data('post-id');
                    var self = $(this);
                    var isLogin = self.data('login');

                    if(isLogin) {
                        $.ajax({
                            url: config.base_path + '/action/action.heart.post.php',
                            type: 'POST',
                            data: { rating: 5, post_id: post_id },
                            success: function(data) {
                                if (data.hearts_given > 0) {
                                    self.addClass('red');
                                    $('span', self).removeClass('glyphicon-heart-empty')
                                        .addClass('glyphicon-heart');
                                } else {
                                    self.removeClass('red');
                                    $('span', self).removeClass('glyphicon-heart')
                                        .addClass('glyphicon-heart-empty');
                                }
                                $('.post[data-post-id="' + post_id + '"] .likes')
                                    .text(data.total + " " + (data.total > 1 ? 'likes' : 'like'));
                            }
                        });
                    } else {
                        alert('Please login first');
                    }
                });
            },

            // comment
            function($) {
                $('form.add-comment').on('submit', function(e) {
                    e.preventDefault();
                    var post_id = $(this).data('post-id');
                    var $form = $(this);
                    if ($('input[name=comment]', $(this)).val().length > 0) {
                        console.log(post_id);
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST',
                            data: $(this).serialize(),
                            success: function(data) {
                                $('.comments-cont[data-post-id="' + post_id + '"]')
                                    .html(data);
                                moments.init();
                                $('input[name=comment]', $form).val('');
                            }
                        });
                    }

                });
            },

            // update profile pic
            function($) {
                console.log($('#profile-image'));
                $('#profile-image').on("change", function() {
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return;

                    if (/^image/.test(files[0].type)) {
                        var reader = new FileReader();
                        reader.readAsDataURL(files[0]);
                        console.log('changing');
                        reader.onloadend = function() {
                            $("#n-pp").attr("src", this.result)
                                .removeClass('hide');
                            $("#c-pp").addClass('hide');
                        }
                    }
                });
            },

            // datepicker
            function($) {
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                $("#book-date").datepicker({
                    autoclose: true,
                    startDate: tomorrow
                }); 

                $('[data-toggle=datepicker], input[type=date]').each(function() {
                    $(this).datepicker({
                        autoclose: true,
                        endDate: '-3d',
                        startView: 'years'
                    });
                });
                
            },

            // select radius
            function($) {
                $('#radius').on('change', function() {
                    $(this).closest('form').submit();
                });
            },

            // reaction 
            function($) {
                $(".like-btn").hover(function() {
                    $(".reaction-icon").each(function(i, e) {
                        setTimeout(function() {
                            $(e).addClass("show-icon");
                        }, i * 100);
                    });
                }, function() {
                    $(".reaction-icon").removeClass("show-icon")
                });
                $('.reaction-icon').click(function() {
                    var post_id = $(this).data('post-id');
                    var rating = $(this).data('rating');
                    var self = $(this);
                    $.ajax({
                        url: config.base_path + '/action/action.heart.post.php',
                        type: 'POST',
                        data: { rating: rating, post_id: post_id },
                        success: function(data) {
                            if (data.hearts_given > 0) {
                                self.addClass('red');
                                $('span', self).removeClass('glyphicon-heart-empty')
                                    .addClass('glyphicon-heart');
                            } else {
                                self.removeClass('red');
                                $('span', self).removeClass('glyphicon-heart')
                                    .addClass('glyphicon-heart-empty');
                            }
                            $('.post[data-post-id="' + post_id + '"] .likes')
                                .text(data.total + " " + (data.total > 1 ? 'likes' : 'like'));
                        }
                    })
                });
            },
            // resize textarea
            function($) {
                var textarea = document.getElementById("text");
                var limit = 200;
                if(textarea) {
                    textarea.oninput = function() {
                        textarea.style.height = "";
                        textarea.style.height = Math.min(textarea.scrollHeight, 300) + "px";
                    };
                }
            },

            function($) {
                $('#placeImage').on("change", function() {
                    var files = !!this.files ? this.files : [];
                    console.log(files);
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function() { // set image data as background of div

                            var img = '<div class="image thumbnail" style="max-width: 300px;">' +
                                '<img src="' + this.result + '" data-action="zoom"/>' +
                                '</div>';

                            $("#imagePrev")
                                .html('')
                                .append(img)
                                .removeClass('hide');
                        }
                    }
                });
            },

            function($) {
                $('#galleryImages').on("change", function() {
                    var files = !!this.files ? this.files : [];
                    
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                    $("#imagesPrev").html('');

                    var count = 0;
                    for(var i=0; i<files.length; i++) {
                        if (/^image/.test(files[i].type)) { // only image file
                            var reader = new FileReader(); // instance of the FileReader
                            reader.readAsDataURL(files[i]); // read the local file

                            reader.onloadend = function() {
                                count += 1;
                                var img = '<div class="image thumbnail col-md-3" style="">' +
                                    '<img src="' + this.result + '" data-action="zoom"/>' +
                                    '</div>';

                                

                                if(count % 4 == 0 ) {
                                    img += '<div class="clearfix"></div>';
                                    count = 0;
                                }

                                $("#imagesPrev")
                                    .append(img)
                                    .removeClass('hide');
                            }
                        }
                    } 
                });
            },
            //tooltip
            function($) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            // change location

            function($) {
                $('#status-form span.location').dblclick(function(e){
                    var location = $(this).text();
                    e.preventDefault();

                    $(this).attr('contentEditable', true).blur(function(){
                        if($(this).text() == '') {
                            $(this).text(location);
                        }
                        $(this).attr('contentEditable', false);
                        $('#status-form #loc').val($(this).text());
                    });
                });
            },

            // approve post
            function($) {
                $('a[data-action="approve-post"]').click(function(e){
                    e.preventDefault()
                    var url = $(this).attr('href');
                    var post_id = $(this).data('post-id');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        success: function(response) {
                            console.log(response);
                            $('.media.post[data-post-id="'+post_id+'"]').addClass('alert alert-success');
                        }
                    });
                });
            },

            //booking

            function ($) {
                var person = $("#book-person").val();
                var price = $('#package-price').val();
                var total = (person * price).format(2)
                $('#book-total').text(total);
                $("#total").val(total);
                $('#book-person').change(function(){
                    var person = $(this).val();
                    var price = $('#package-price').val();
                     var total = (person * price).format(2)
                    $('#book-total').text(total);
                    $("#total").val(total);
                });

                $('#booking-form').validator().on('submit', function(e) {
                    $form = $(this);
                    if (e.isDefaultPrevented()) {

                    } else {
                        e.preventDefault();
                        $.ajax({
                            url: $form.attr('action'),
                            type: 'POST',
                            data: $form.serialize(),
                            success: function(response) {
                                $('.alert', $form).remove();
                                if(response.status == 'success') {
                                    $form.addClass('hide');
                                    $form.parent().append('<div class="alert alert-success">'+response.message+'</div>');
                                } else {
                                    $form.parent().append('<div class="alert alert-danger">'+response.message+'</div>');
                                }
                            }
                        });
                    }
                });
            },

            // cancel booking
            function ($) {
                $('[data-action="cancel-booking"]').click(function(e){
                    var $button = $(this);
                    $.ajax({
                        url: config.base_path + '/action/action.cancel.booking.php',
                        type: 'POST',
                        data: { action: 'cancel', status_code: $button.data('status-code'), booking_id: $button.data('booking-id') },
                        success: function(response) {
                            if(response.status == 'success') {
                                alert('Successfully cancelled');
                                window.location.reload();
                            }
                        }
                    });
                });
            },

            // admin: change booking status

            function($) {
                $('[data-action="change-status"]').change(function(e){
                    var status_code = $(this).val();
                    var booking_id = $(this).data('booking-id');
                    $.ajax({
                        url: config.base_path + '/action/action.update.booking.status.php',
                        type: 'POST',
                        data: { action: 'update', status_code: status_code, booking_id: booking_id },
                        success: function(response) {
                            console.log(response);
                            if(response.status == 'success') {
                               // alert('Successfully cancelled');
                                window.location.reload();
                            }
                        }
                    });
                });
            },

            // delete package
            function($) {
                $('[data-action="delete-package"]').click(function(e){
                    e.preventDefault();
                    var del = confirm("Are you sure you want to delete this?");
                    var self = $(this);
                    if(del) {
                        $.ajax({
                            url: config.base_path + '/action/action.delete.package.php',
                            type: 'POST',
                            data: { action: 'delete', package_id: self.data('package-id') },
                            success: function(response) {
                                if(response.status == 'success') {
                                    self.closest('tr').remove();
                                }
                            }
                        });

                    } else {
                        
                    }
                });
            },

            // delete place
            function($) {
                $('[data-action="delete-place"]').click(function(e){
                    e.preventDefault();
                    var del = confirm("Are you sure you want to delete this?");
                    var self = $(this);
                    if(del) {
                        $.ajax({
                            url: config.base_path + '/action/action.delete.place.php',
                            type: 'POST',
                            data: { action: 'delete', place_id: self.data('place-id') },
                            success: function(response) {
                                if(response.status == 'success') {
                                    self.closest('tr').remove();
                                }
                            }
                        });

                    } else {
                        
                    }
                });
            },

            // delete gallery
            function($) {
                $('[data-action="delete-gallery"]').click(function(e){
                    e.preventDefault();
                    var del = confirm("Are you sure you want to delete this?");
                    var self = $(this);
                    if(del) {
                        $.ajax({
                            url: config.base_path + '/action/action.delete.gallery.php',
                            type: 'POST',
                            data: { action: 'delete', gallery_id: self.data('gallery-id') },
                            success: function(response) {
                                if(response.status == 'success') {
                                    self.closest('tr').remove();
                                }
                            }
                        });

                    } else {
                        
                    }
                });
            }

        ],
        initAll = function() {
            initEvt();
        },
        initEvt = function() {
            evt.forEach(function(e) {
                e($, document);
            });
        };

    return { init: initAll };

})(jQuery, document);

footnote.init();
moments.init();