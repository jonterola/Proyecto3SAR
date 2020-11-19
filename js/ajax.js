function showAll(i) {
    $idnt = i;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "ShowAllAjax.php",
        data: { id: i },
        success: function (response) {
            var newData = JSON.stringify(response)
            var data = JSON.parse(newData);
            $div = '#text' + i;
            $($div).html(data.text);
        }
    });

}
