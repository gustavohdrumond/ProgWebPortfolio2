$(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).children().eq(1).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

function Alterar(id) {
    var url = window.location.href.split('/');
    url = url.splice(0, url.length - 1).join('/');

    $.ajax({
        url: 'json.php',
        type: 'POST',
        dataType: 'JSON',
        data: { id: id },
        success: function(res) {
            $.each(res, function(idx, obj){
                $("#" + idx).val(obj);
            });
        },
        error: function() {
            alert('Algo deu errado');
        }
    });
}

function Excluir(id) {
    var url = window.location.href.split('/');
    url = url.splice(0, url.length - 1).join('/');

    window.location = url + '?acao=ExcluirRegistro&id=' + id;

}