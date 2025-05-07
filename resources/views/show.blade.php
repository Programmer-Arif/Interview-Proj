<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Single product</h1>




    <script>

        $(document).ready(function(){
            $(document).on('click','.button-show',function(e){
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: `/products/${id}`,
                type: 'GET',
                success: function(data){
                    if(data.status==true){
                    console.log(data.data);
                
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