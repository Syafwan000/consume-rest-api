<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Rest API</title>
</head>
<body>

<div class="container my-4">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addData"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add</button>
    @if(session()->has('messageSuccess'))
        <div class="alert alert-success mt-4" role="alert">
            <i class="fa-solid fa-square-check"></i>&nbsp;&nbsp;{!! session('messageSuccess') !!}
        </div>
    @endif
    @if(session()->has('messageFailed'))
        <div class="alert alert-danger mt-4" role="alert">
            <i class="fa-solid fa-circle-xmark"></i></i>&nbsp;&nbsp;{!! session('messageFailed') !!}
        </div>
    @endif
    <table class="table table-striped table-hover mt-4">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users['data'] as $user)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $user['firstName'] }}</td>
                    <td>{{ $user['lastName'] }}</td>
                    <td>
                        {{-- Edit --}}
                        <button type="button" class="badge bg-primary mb-2" data-bs-toggle="modal" data-bs-target="#editData{{ $user['id'] }}"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;Edit</button>
                        <form method="post" action="{{ 'users/' . $user['id'] }}">
                            @method('put')
                            @csrf
                            <div class="modal fade" id="editData{{ $user['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">User ID</label>
                                                <input type="text" class="form-control" id="recipient-name" value="{{ $user['id'] }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">First Name</label>
                                                <input type="text" class="form-control" name="firstName" id="recipient-name" value="{{ $user['firstName'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Last Name</label>
                                                <input type="text" class="form-control" name="lastName" id="recipient-name" value="{{ $user['lastName'] }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Delete --}}
                        <button type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteData{{ $user['id'] }}"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Delete</button>
                        <form method="post" action={{ 'users/' . $user['id'] }}>
                            @method('delete')
                            @csrf
                            <div class="modal fade" id="deleteData{{ $user['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure to delete this data ?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" align="center">No Data</td>
                </tr>
            @endforelse
    </tbody>
    </table>
</div>

<form method="post" action="users">
    @csrf
    <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastName" id="recipient-name">
                    </div>
                    <input type="hidden" name="email" value="{{ Str::random(7) . '@' . 'example.com' }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add</button>
                </div>
            </div>
        </div>
    </div>
</form>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>