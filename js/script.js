var apiHost = 'api.php';
var sesionId = null;

function fillGrid() {

    $.ajax({
        type: "GET",
        url: apiHost + '?c=init',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        //data: {},
        //dataType: 'json'
    })
        .done(function (data) {
            sesionId = data.sessionId;
            console.log(data);
            $("#list").empty();
            $("#check-button-group").hide();
            var string = nunjucks.renderString($("#templateCards").html(), {lot: data.cards});
            $("#list").append(string);
            fillHistory();
        });

}


function fillHistory() {

    $.ajax({
        type: "GET",
        url: apiHost + '?c=history&s=' + sesionId,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        //data: {},
        //dataType: 'json'
    })
        .done(function (data) {
            sesionId = data.sessionId;
            console.log(data);
            $("#history").empty();
            var string = nunjucks.renderString($("#templateHistory").html(), {lot: data.psychics});
            $("#history").append(string);

            $("#checks-history").empty();
            var string = nunjucks.renderString($("#templateChecksHistory").html(), {lot: data.checks});
            $("#checks-history").append(string);


        });

}



$('#extra').on('click', function () {
    $.ajax({
        type: "POST",
        url: apiHost + '?c=test&s=' + sesionId,
        data: {
        },
        //dataType: 'json'
    })
        .done(function (data) {
            console.log(data);
            $("#extra-list").empty();
            $("#win").empty();
            $("#check-number").val('');
            $("#check-button-group").show();
            var string = nunjucks.renderString($("#templateExtra").html(), {lot: data.psychics});
            $("#extra-list").append(string);
            fillHistory();
        });
});


$('#check').on('click', function () {
    $.ajax({
        type: "POST",
        url: apiHost + '?c=check&s=' + sesionId,
        data: {
            number: $("#check-number").val()
        },
        //dataType: 'json'
    })
        .done(function (data) {
            console.log(data);
            $("#win").empty();
            var string = nunjucks.renderString($("#templateWin").html(), {lot: data.result});
            $("#win").append(string);
            fillHistory();
        });
});


fillGrid();