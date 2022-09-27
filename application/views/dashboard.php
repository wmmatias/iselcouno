<div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-10 offset-md-1 p-4 position-relative">
                <h1 class="d-inline-block">All Products</h1>
                <div class="table_container table table-responsive-sm">              
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Inventory Count</th>
                                <th>Quantity Sold</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                       for($i=0; $i<count($list); $i++){
?>                            <tr>
                                <td><?=$list[$i]['id']?></td>
                                <td><a href="products/show/<?=$list[$i]['id']?>"><?=$list[$i]['name']?></a></td>
                                <td><?=$list[$i]['inventory_count']?></td>
                                <td><?=$list[$i]['quantity_sold']?></td>
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