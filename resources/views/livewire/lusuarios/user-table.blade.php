<div>

    <div v class="col-lg-12 mb-lg-0 mb-4">

          

        <div class="card z-index- h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h4 class="">Lista de usuarios</h4>
            
            {{-- <p class="text-sm mb-0">
              <i class="fa fa-arrow-up text-success"></i>
              <span class="font-weight-bold">4% more</span> in 2021
            </p> --}}
          </div>
         
            <div class="card-body p-3">

                {{-- tabla usuarios --}}
                <div class="card-header">
                    <input wire:model="search"  class="form-control" placeholder="Ingrese el nombre,email o rol de usuario a buscar">
                </div>
                @if ($users->count())  
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr id={{$user->idUser}}>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img  src="images/{{ $user->photo }}" alt="{{ $user->name }}" class="mr-2" width="30">
                                        <span style="margin-left:10px" >{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
            
                              
                                
                                <td>  
                                    <select class="form-select selectRole" aria-label="Select Role" >
                                        @foreach ($roles as $role)
                                            <option  value="{{ $role->id }}" {{ $user->idRol == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                   
                </table>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
                @else
                    <div class="card-body">
                        <strong>No se encontraron usuarios</strong>
                    </div> 
                @endif



            </div>
        </div>
    </div>



</div>
