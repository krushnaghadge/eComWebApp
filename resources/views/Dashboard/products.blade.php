<x-admin-header/>
      <!-- partial -->
      {{-- <div class="main-panel">
        <div class="content-wrapper">
          --}}
        
       
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top Products</p>




                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
 Add New
</button>



<div class="modal" id="addNewModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
     <form action="{{ url('/') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title" placeholder="Title" class="form-control mb-2">

    <label for="price">Price</label>
    <input type="text" name="price" id="price" placeholder="Price" class="form-control mb-2">

    <label for="quantity">Quantity</label>
    <input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control mb-2">

    <label for="picture">Picture</label>
    <input type="file" name="picture" id="picture" class="form-control mb-2">

    <label for="description">Description</label>
    <input type="text" name="description" id="description" placeholder="Description" class="form-control mb-2">

    <label for="category">Category</label>
    <select name="category" id="category" class="form-control mb-2">
        <option value="Electronics">Electronics</option>
        <option value="Repair">Repair</option>
    </select>

    <label for="type">Type</label>
    <select name="type" id="type" class="form-control mb-2">
        <option value="new_arrival">New Arrival</option>
        <option value="new">New</option>
    </select>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

      </div>

      

    </div>
  </div>
</div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @foreach ($products as $item )
                           <tr>
                          <td>{{ $item->title }}</td>
                          <td class="font-weight-bold">${{ $item->quantity }}</td>
                          <td>{{ $item->category }}</td>
                          <td class="font-weight-medium"><div class="badge badge-success">{{ $item->category }}</div></td>
                        </tr>
                    
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
         
        


        <!-- content-wrapper ends -->
       <x-adminfooter/>