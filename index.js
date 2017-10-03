$(document).ready(function() {
  $("#money-channel").keyup(function(event){
    if(event.keyCode == 13){
      $("#money-check").click();
    }
  });
  $("#money-check").click(function() {
    $("#money-check").attr("disabled", true);
    $("#money-result").hide();
    var channelName = $("#money-channel").val();

    $.ajax({
      type: 'GET',
      url: "channel.php",
      data: { name: channelName },
      dataType: 'json'
    })
    .fail(function(xhr, textStatus, errorThrown) {
      if (xhr.status == 404) {
        $("#money-check").attr("disabled", false);
        $("#money-result").show();
        $("#money-result").html('<div class="w3-white w3-text-red"><p>Oups! No channel found!</p></div>');
      }
    })
    .done(function(data) {
      $("#money-check").attr("disabled", false);
      $("#money-result").show();
      $("#money-result").html(
        '<a href="https://www.youtube.com/channel/'+data.id+'"><img src="'+data.thumbnail+'" height="96" width="96" /></a> <div class="w3-white w3-opacity w3-hover-opacity-off">' +
        data.title + "<br />" +
        data.statistics.money + " $ </div>");
    });
  });

  // XXX code duplication
  $("#productivity-channel").keyup(function(event){
    if(event.keyCode == 13){
      $("#productivity-check").click();
    }
  });
  $("#productivity-check").click(function() {
    $("#productivity-check").attr("disabled", true);
    $("#productivity-result").hide();
    var channelName = $("#productivity-channel").val();

    $.ajax({
      type: 'GET',
      url: "channel.php",
      data: { name: channelName },
      dataType: 'json'
    })
    .fail(function(xhr, textStatus, errorThrown) {
      if (xhr.status == 404) {
        $("#productivity-check").attr("disabled", false);
        $("#productivity-result").show();
        $("#productivity-result").html('<div class="w3-white w3-text-red"><p>Oups! No channel found!</p></div>');
      }
    })
    .done(function(data) {
        $("#productivity-check").attr("disabled", false);
        $("#productivity-result").show();
        $("#productivity-result").html(
            '<a href="https://www.youtube.com/channel/'+data.id+'"><img src="'+data.thumbnail+'" height="96" width="96" /></a><div class="w3-white w3-opacity w3-hover-opacity-off">' +
            data.title + "<br />" +
            data.statistics.videoPerMonth + " videos/month </div>");
    });
  });
});