<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Logged in as
            <b>
              <strong>{{ Auth::user()->name }}</strong>
            </b>
            <b style="float:right;"> Total Users
              <span class="badge badge-danger">{{ count($users) }}</span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
      <div class="container">
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">SL No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody>

              @php($i = 1) <!--Increament of list-->
              @foreach($users as $user)

              <tr>
                <th scope="row">{{ $i++ }}</th> <!--Auto Increament of list-->
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
              </tr>

              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>





</x-app-layout>
