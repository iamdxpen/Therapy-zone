$(function () {
  /**
   * Blog search 
   */
  $("#search-button").on("click", function () {
    searchBlog();
  });

  $("#search_text").keypress(function (event) {
    if (event.which === 13) {
      searchBlog();
    }
});

  /**
   * Copy Blog Url.  
   */
  $("#copy-share-btn").on("click", function () {
    var input = document.getElementById($(this).attr('id')).appendChild(document.createElement("input"));
    input.value = $(this).data('href');
    input.focus();
    input.select();
    document.execCommand('copy');
    input.parentNode.removeChild(input);
    $(this).find(".tooltiptext").show();
    $(this).find('.tooltiptext').html('Copied: ' + $(this).data('href'));
    setTimeout(function () {
      $(this).find(".tooltiptext").hide();
      $(this).find(".tooltiptext").html("<span>Copy to clipboard</span>");
    }, 2000);
  });

  /**
   * Copy Text Chnage on Hover.  
   */
  $("#copy-share-btn").hover(
    function () {
      // This function will be executed on mouseover
      $(this).find('.tooltiptext').html("<span>Copy to clipboard</span>");
    }
  );

  function searchBlog() {
    let search_keyword = $("#search_text").val();
    let url = $("#search_text").data("url");
    window.location.href = url + "?s=" + search_keyword;
  }
});