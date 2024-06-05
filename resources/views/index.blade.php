<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="bg-gray-100 p-4">
        <div class="lg:w-2/4 mx-auto py-8 px-6 bg-white rounded-xl">
            <h1 class="font-bold text-3xl text-center mb-4 mt-4">
                TODO Application
            </h1>
            <div class="mb-6">
                <form class="flex flex-col space-y-4" action="/" method="post">
                    @csrf
                    <input type="text" class="py-3 px-4 bg-gray-200 rounded-xl" value="{{ old('task_name') }}" placeholder="TODO Title" name="task_name" id="">
                    @error('task_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <textarea name="task_desc" class="py-3 px-4 bg-gray-200 rounded-xl" placeholder="Task description here..." id="">{{ old('task_desc') }}</textarea>
                    @error('task_desc')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="w-28 py-3 px-4 bg-green-600 text-white text-bold rounded-xl">Add</button>
                </form>
            </div>
            <hr>
            <div class="mt-2">
                @foreach ($todos as $todo)
                <div class="py-4 flex items-center border-b border-gray-400 px-3">
                    <div class="flex-1 pr-8">
                        <h3 class="text-lg font-semibold">{{ $todo->todo_title }}</h3>
                        <p class="text-gray-400">{{ $todo->todo_description }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="todo/{{ $todo->id }}/update" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal" onclick="populateModal({{ $todo->id }}, '{{ $todo->todo_title }}', '{{ $todo->todo_description }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM16.862 4.487L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <a href="todo/{{ $todo->id }}/destroy" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9L14.394 18m-4.788 0L9.26 9m9.968-3.21a48.108 48.108 0 001.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.11 48.11 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <hr>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Todo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editTodoForm" action="" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editTodoId">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="task_name" id="editTodoTitle" placeholder="Todo Title">
                                <label for="editTodoTitle">Todo Title</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="task_desc" id="editTodoDescription" placeholder="Todo Description" style="height: 100px"></textarea>
                                <label for="editTodoDescription">Todo Description</label>
                            </div>
                            <button type="submit" class="btn btn-success float-end">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function populateModal(id, title, description) {
            document.getElementById('editTodoId').value = id;
            document.getElementById('editTodoTitle').value = title;
            document.getElementById('editTodoDescription').value = description;
            document.getElementById('editTodoForm').action = `/todo/${id}/update`;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
