<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>All Products</h1>

    <a href="/products/create">Create Product</a>
    <br>
    <br>


    <div id="product-wrap">

    </div>
    <div id="show" style="display: none">
        <h3>Show Product</h3>
        <p id="show-name"></p>
        <p id="show-price"></p>
        <img src="" alt="">
        <button type="button" id="close-show">Close</button>
    </div>
</body>

    <script>
        $(document).ready(function(){
            
            function loaddata(){  
                $.ajax({
                    url: "/products",
                    type: 'GET',
                    success: function(data){
                        if(data.status==true){
                        const allproducts = data.data;
                        const productwrap = document.querySelector('#product-wrap');
                        var id=1;

                        var tabledata = `<table>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Image</th>
                                                    <th>Show</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                                                allproducts.forEach(product => {
                                                tabledata += `<tr>
                                                                <td>${id++}</td>
                                                                <td>${product.name}</td>
                                                                <td>${product.price}</td>
                                                                <td><img width="25px" height="25px" src="storage/uploads/${product.image}" alt=""></td>
                                                                <td><button class="button-show" data-id="${product.id}">Show</button></td>
                                                                <td><button class="button-edit" data-id="${product.id}">Update</button></td>
                                                                <td><button class="button-delete" data-id="${product.id}">Delete</button></td>
                                                            </tr>`;
                                            });
                                                
                                            tabledata += `</tbody>
                                        </table>`;
                                        productwrap.innerHTML = tabledata;

                        


                    }
                    },
                    error: function(response){
                            alert("Error: "+response.responseJSON.message);
                    }
                });

        }
        loaddata();


        $(document).on('click','.button-show',function(e){
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: `/products/${id}`,
                type: 'GET',
                success: function(data){
                    if(data.status==true){
                        console.log(data.data);
                        $('#show').show();
                        $('#show-name').html(data.data.name);
                        $('#show-price').html(data.data.price);
                
                    }
                },
                error: function(response){
                        alert("Error: "+response.responseJSON.message);
                }
            });
        })

        $('#close-show').click(function(){
            $('#show').hide();
        })




        $(document).on('click','.button-edit',function(e){
            var id = $(this).data('id');
            console.log(id);
            window.location.href = `http://127.0.0.1:8000/products/${id}/edit`;
        
        })






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

        






        })
        
    </script>


</html>