$(document).ready(function() {
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#key-act-button').DataTable({        
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "category-data",

        columnDefs : [
            { responsivePriority: 1, targets: -1 }
        ],
        dataSrc: 'data',
        columns : [
            {data : "id"},
            {data : "name"},
            {data : "id_user"},
            {data : "id",
                render: function(data, type, row) {
                    return `<a id="editCategory" class=" btn btn-md btn-success" data-id='`+data +`' style="color: white;">Ubah</a>
                            <a id="deleteCategory" class=" btn btn-md btn-danger" data-id='`+data +`' style="color: white;">Hapus</a>`;
                }
            },
        ]
    });

    $('#addCategory').click(function(){
        $('#formAddCategory').trigger('reset');
        $('#modalCategory').modal('show');
        $('#id').val();
    });

    $(document).on('click', '#editCategory', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('category-data/'+id, function(data){
            $('#modalCategory').modal('show');
            $('#id').val(data.data.id);
            $('#name').val(data.data.name);
            $('#id_user').val(data.data.id_user);            
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddCategory').trigger("reset");
    });

    $('#submitButton').click(function(e){
        e.preventDefault();
        
        var formData = {
            data : new FormData(document.getElementById('formAddCategory')),
            id: $('#id').val(),
        }
        console.log(formData);

        if(formData.id){
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "category/"+formData.id,
                type: "PUT",
                dataType: "json",
                success : function(data){
                    $('#formAddCategory').trigger("reset");
                    $('#modalCategory').trigger("reset");
                    $('#modalCategory').modal('hide');
                    $('#key-act-button').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddCategory').trigger("reset");
                    $('#modalCategory').modal('hide');
                    $('#modalCategory').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "category",
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddCategory').trigger("reset");
                    $('#modalCategory').trigger("reset");
                    $('#modalCategory').modal("hide");
                    $('#key-act-button').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message,"success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddCategory').trigger("reset");
                    $('#modalCategory').modal('hide');
                    $('#modalCategory').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteCategory', function(e){
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
                    url: 'category/'+id,
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