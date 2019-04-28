@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- profile picture --}}
        <div class="d-flex flex-column align-items-center mb-3">

        <img class="rounded-circle mx-auto mb-2" src="{{ asset('img/man.jpg') }}" width="120" alt="profile picture">
            <div class="btn btn-outline-primary py-0">upload</div>
        </div>

        {{-- End of profile picture --}}

        {{-- setting table --}}
         <table class="table table-borderless table-hover ">
             <tbody class="">
             <tr>
                 <th class="text-right">Full Name:</th>
                 <td class="col">Eslam Fakhry</td>
                 <td><button class="btn btn-primary">edit</button></td>
             </tr>
             <tr>
                 <th class="text-right">Username:</th>
                 <td>eslamfakhry</td>
                 <td><button class="btn btn-primary">edit</button></td>
             </tr>
             <tr>
                 <th class="text-right">Email:</th>
                 <td>eslam@fakhry.me</td>
                 <td><button class="btn btn-primary">edit</button></td>
             </tr>
             <tr>
                 <th class="text-right">Bio:</th>
                 <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At consequuntur corporis cumque delectus error est facere id in incidunt ipsam itaque optio quae quaerat quibusdam, quod suscipit temporibus totam voluptatum!</td>
                 <td><button class="btn btn-primary">edit</button></td>
             </tr>
             <tr>
                 <th class="text-right">Languages:</th>
                 <td>
                     <div class="">Arabic <small>
                             <div class="badge badge-pill badge-primary pl-1">primary</div>
                         </small></div>
                     <div class="">English</div>
                     <div class="">Spanish</div>
                 </td>
                 <td><button class="btn btn-primary">edit</button></td>
             </tr>
             <tr>
                 <td class="text-right">
                     <a href="#" class="btn btn-danger">Delete account</a>
                 </td>
             </tr>
             </tbody>
         </table>
        {{-- End of setting table --}}
    </div>
@endsection
