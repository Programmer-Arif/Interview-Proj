<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

    <h1>Update Product</h1>

    <form id="update-form" type="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id-updt" value="5"><br>
        <input type="text" name="name" placeholder="Enter Product Name" id="name"><br>
        <input type="text" name="price" placeholder="Enter Product Price" id="price"><br>
        <input type="file" name="image" id="image"><br>
        <input type="submit" value="Update Product" id="update-button">
    </form>


    <script>


        $(document).on('click','.button-delete',function(e){
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: `/products/${id}`,
                type: 'DELETE',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.status==true){
                        console.log(data.data);
                        loaddata();
                
                    }
                },
                error: function(response){
                        alert("Error: "+response.responseJSON.message);
                }
            });
        })


        $(document).ready(function(){
                
                $('#update-form').submit(function(e){
                    e.preventDefault();
                    var id = $('#id-updt').val();
                $.ajax({
                    url: `/products/${id}`,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-HTTP-Method-Override': 'PUT'

                    },
                    data: new FormData(document.querySelector('#update-form')),
                    success: function(data){
                        if(data.status==true){
                            window.location.href = "http://127.0.0.1:8000/product";
                        }
                        else{
                            console.log('Failed');
                        }
                    },
                    error: function(response){
                            alert("Error: "+response.responseJSON.message);
                    }
                });
            })
        })

    </script>
</body>
</html>