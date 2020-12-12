<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category

        </h2>
    </x-slot>

    <div class="py-12">

      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card">

              <!-- Dispaly success message-->
              @if(session('success'))
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{ session('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              <div class="card-header">
                All Category
              </div>


          <table class="table">
            <thead>
              <tr>
                <th scope="col">Category ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">User</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <!--@php($i = 1) Increament of list-->
              @foreach($categories as $category)
              <tr>
                <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                <td> {{ $category->category_name }} </td>
                <td> {{ $category->user->name }} </td>
                <td>
                  @if($category->created_at == NULL)

                  <span class="text-danger"> Date N/A</span>

                  @else

                  {{ $category->created_at->diffForHumans() }}
                  @endif
                </td>
                <td>
                  <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                  <a href="{{ url('firstdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                </td>

              </tr>
              @endforeach


            </tbody>
          </table>
          <!--Pagination-->
          {{ $categories->links() }}


        </div>
      </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Add Category</div>
              <div class="card-body">



              <form action="{{ route('store.category') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                  </div>

                <button type="submit" class="btn btn-primary">Add Category</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <br>
      <br>




<!--- Start Trash Part-->
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card">


              <div class="card-header">
                Deleted List
              </div>


          <table class="table">
            <thead>
              <tr>
                <th scope="col">Category ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">User</th>
                <th scope="col">Deleted At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <!--@php($i = 1) Increament of list-->
              @foreach($trashCateegory as $category)
              <tr>
                <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                <td> {{ $category->category_name }} </td>
                <td> {{ $category->user->name }} </td>
                <td>
                  @if($category->created_at == NULL)

                  <span class="text-danger"> Date N/A</span>

                  @else

                  {{ $category->created_at->diffForHumans() }}
                  @endif
                </td>
                <td>
                  <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                  <a href="{{ url('category/finaldelete/'.$category->id) }}" class="btn btn-danger">Delete Permanently</a>
                </td>

              </tr>
              @endforeach


            </tbody>
          </table>
          <!--Pagination-->
          {{ $trashCateegory->links() }}


        </div>
      </div>

        <div class="col-md-4">

        </div>
        <!--- Start Trash Part-->
</div>

</x-app-layout>
