<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <h1>Create Product</h1>

    <form id="add-form" type="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter Product Name" id="name"><br>
        <input type="text" name="price" placeholder="Enter Product Price" id="price"><br>
        <input type="file" name="image" id="image"><br>
        <input type="submit" value="Save Product" id="add-button">
    </form>

    <script>

        $(document).ready(function(){
                
                $('#add-form').submit(function(e){
                    e.preventDefault();
                $.ajax({
                    url: "/products",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(document.querySelector('#add-form')),
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
</html><?php /**PATH C:\Project Internship\crudappli\resources\views/create.blade.php ENDPATH**/ ?>