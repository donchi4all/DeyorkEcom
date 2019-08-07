

 <table class="table table-striped m-b-none" data-ride="datatables" id="table">
                    <thead>
                        <tr>
                            <th width="">Name</th>
                            <th width="">Role</th>
                            
                            <th width="">Email</th>
                            <th width="">Type</th>
                            <th width="150px">Buttons</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{  $user->name}}</td>
                                <td>{{ $user->type  }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->verified  }}</td>
                                <td>
                                    {{ Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete', 'style'=>'display:inline-block']) }}
                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')" ><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('user.show',$user->id) }}" class="btn btn-sm btn-icon btn-success"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>