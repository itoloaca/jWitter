function updateCountdown() {
    // 140 is the max message length
    var remaining = 140 - jQuery('#post_content').val().length;
    jQuery('.countdown').text(remaining + ' characters left ');
}

jQuery(document).ready(function($) {
    updateCountdown();
    $('#post_content').change(updateCountdown);
    $('#post_content').keyup(updateCountdown);
});
