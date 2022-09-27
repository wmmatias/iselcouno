    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-10 offset-md-1 p-4 position-relative">
                <h1 class="d-inline-block">Manage Products</h1>
                <a href="products/new" class="btn btn-primary position-absolute top-0 end-0 mt-4 me-4">Add new</a>
                <div class="table_container table table-responsive-sm">              
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Inventory Count</th>
                                <th>Quantity Sold</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                       for($i=0; $i<count($list); $i++){
?>                            <tr>
                                <td><?=$list[$i]['id']?></td>
                                <td><a href="products/show/<?=$list[$i]['id']?>"><?=$list[$i]['name']?></a></td>
                                <td><?=$list[$i]['inventory_count']?></td>
                                <td><?=$list[$i]['quantity_sold']?></td>
                                <td><a href="products/edit/<?=$list[$i]['id']?>" class="ms-2">Edit</a><a href="products/delete/<?=$list[$i]['id']?>" class="ms-2" onclick="return confirm('Are you sure you want to DELETE this?')">Remove</a></td>
                            </tr>
<?php                       }
?>                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>