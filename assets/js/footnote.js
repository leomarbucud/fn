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

                $('form#status-form').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    console.log(formData);
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function(data) {
                            var newPost = `
                            <div class="media post" data-post-id="{0}">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle" src="{1}" width="50" height="50" />
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="name"><a href="#">{2}</a></h4>
                                    <label class="my-location"><span class="glyphicon glyphicon-map-marker"></span> {3}</label>
                                    <span class="moment" data-toggle="moment">{4}</span>
                                    <div class="image">
                                        <img class="" src="{5}&type=post" />
                                    </div>
                                    <p>{6}</p>
                                    <span class="likes">0 like</span>
                                    <hr>
                                    <div class="actions">
                                        <form class="add-comment" action="/fn/action/action.comment.php" data-toggle="validator" data-post-id="{0}>">
                                            <input type="hidden" name="post_id" value="{0}" />
                                            <input type="text" name="comment" class="form-control comment-box" placeholder="Write comment..." required/>
                                        </form>
                                        <a href="#" data-toggle="like" data-post-id="{0}" class="favorite"><span class="glyphicon glyphicon-heart-empty"></span></a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <hr>
                            `;
                            $('.post-list').prepend(String.format(newPost,
                                data.post_id,
                                config.profile_pic + '/' + data.profile,
                                data.firstname + ' ' + data.lastname,
                                data.location,
                                data.post_created,
                                config.post_pic + data.media_hash,
                                data.post_text

                            ));
                            $(".image-preview").addClass('hide');
                            $('#text').val('');
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
                $('[data-toggle=datepicker], input[type=date]').each(function() {
                    $(this).datepicker({});
                    console.log($(this));
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

                textarea.oninput = function() {
                    textarea.style.height = "";
                    textarea.style.height = Math.min(textarea.scrollHeight, 300) + "px";
                };
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