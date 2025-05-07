<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Create Product</h1>

    <form id="add-form">
        <input type="text" name="name" placeholder="Enter Product Name"><br>
        <input type="text" name="price" placeholder="Enter Product Price"><br>
        <input type="file" name="image"><br>
        <input type="submit" value="Save Product">
    </form>

    <script>

        $(document).ready(function(){
                $('#add-form').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "/products/store",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: new FormData($('add-form')[0]),
                    success: function(data){
                        if(data.status==true){
                            console.log(data);
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
</html><?php /**PATH C:\Project Internship\crudappli\resources\views\create.blade.php ENDPATH**/ ?>