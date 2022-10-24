$(document).ready(function() {
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    //crud ajaxSetup
    $('#key-act-button').DataTable({        
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "article-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1 }
        ],
        dataSrc: 'data',
        columns : [
            {data : "id"},
            {data : "title"},
            {data : "content"},
            {data : "image",
                render: function(data, type, row){
                    return '<img src="' + data + '" height="50" width="50"/>';
                }
            },
            {data : "id_user"},
            {data : "id_category"},
            {data : "id",
                render: function(data, type, row) {
                    return `<a id="editArticle" class=" btn btn-md btn-success" data-id='`+data +`' style="color: white;">Ubah</a>
                            <a id="deleteArticle" class=" btn btn-md btn-danger" data-id='`+data +`' style="color: white;">Hapus</a>`;                            
                }
            },
        ],
    });

    $('#addArticle').click(function(){
        $('#formAddArticle').trigger('reset');
        $('#modalArticle').trigger("reset");
        $('#modalArticle').modal('show');
        $('#id').val('');
    });

    $(document).on('click', '#editArticle', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('/article-data/'+id, function(data){
            $('#modalArticle').modal('show');
            $('#id').val(data.data.id);
            $('#title').val(data.data.title);
            $('#content').val(data.data.content);            
            $('#id_user').val(data.data.id_user);
            $('#id_category').val(data.data.id_category);            
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddArticle').trigger("reset");
    });

    $('#submitButton').click(function(e){
        e.preventDefault();
        
        var formData = {
            data : new FormData(document.getElementById('formAddArticle')),
            id: $('#id').val(),
        }
        console.log(formData)
        if(formData.id){            
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "article/"+formData.id,
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddArticle').trigger("reset");
                    $('#modalArticle').trigger("reset");
                    $('#modalArticle').modal('hide');
                    $('#key-act-button').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddArticle').trigger("reset");
                    $('#modalArticle').trigger("reset");
                    $('#modalArticle').modal('hide');
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/article",
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddArticle').trigger("reset");
                    $('#modalArticle').trigger("reset");
                    $('#modalArticle').modal("hide");
                    $('#key-act-button').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message,"success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddArticle').trigger("reset");
                    $('#modalArticle').trigger("reset");
                    $('#modalArticle').modal('hide');
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteArticle', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "You want to delete this data?",
            type: "warning",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
            cancelButtonText: "No"
        }).then((result)=> {
            if(result.value){
                $.ajax({
                    url: '/article/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#key-act-button').DataTable().ajax.reload();
                            Swal.fire("Successfull", data.message, "success");
                        } else {
                            Swal.fire("Wrong request", data.message, "error");
                        }
                    }
                });
            } else if(result.dismiss){
                Swal.fire("Canceled", "Your data is safe", "error");
            }
        });
    });

});