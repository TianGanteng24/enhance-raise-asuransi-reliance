    // Reset Form modal
    function resetForm(){
        $("[name='nm_investigator']").val("")
        $("[name='keterangan']").val("")
        $("[name='telp']").val("")
    }
    //
    
    $("#createForm").on("submit",function(e){
        e.preventDefault()
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            url: "investigator",
            method: "POST",
            data: $(this).serialize(),
            success:function(){
                $("#modal-add").modal("hide")
                $('.js-dataTable-buttons').DataTable().ajax.reload();
                One.helpers('jq-notify', 
                {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                resetForm()
            }
        })
    })


    //Edit & Update
$('body').on("click",".btn-edit",function(){
    var id = $(this).attr("id");
    $('#form_result').html('');
     console.log(id);
    $.ajax({
        url: "/investigator/"+id+"/edit",
        method: "GET",
        dataType : "json",
        success:function(html){
            $("#modal-edit").modal("show")
            $("#id").val(html.data.id)
            $("#editnm_investigator").val(html.data.nm_investigator)
            $("#editalamat").val(html.data.alamat)
            $("#edittelp").val(html.data.telp)
        }
    });
});

$("#editForm").on("submit",function(e){
    e.preventDefault()
    var id = $("#id").val()
    var dt = $(this).serialize();
    console.log(id);
    console.log(dt);
    $.ajax({
        url: "/investigator/"+id,
        method: "PATCH",
        data: $(this).serialize(),
        success:function(){
            $('.js-dataTable-buttons').DataTable().ajax.reload();
            $("#modal-edit").modal("hide")
            One.helpers('jq-notify', 
                {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
        }
    })
})
//Edit & Update

    $('body').on("click",".btn-delete",function(){
        var id = $(this).attr("id");
        var kd = $(this).attr("id");
        $(".btn-destroy").attr("id",id);
        $("#destroy-modalLabel").text("Yakin Hapus Data :");
        $("#modal-delete").modal("show");
    });

    $(".btn-destroy").on("click",function(){
        var id = $(this).attr("id")
        console.log(id);
        $.ajax({
            url: "investigator/"+id,
            method : 'DELETE',
            success:function(){
                $("#modal-delete").modal("hide")
                $('.js-dataTable-buttons').DataTable().ajax.reload();
                One.helpers('jq-notify', 
                {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
            },
            error: function(xhr, status, error){
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Jenis klaim tidak bisa dihapus! Sudah digunakan di investigasi');
            },
        });
    })