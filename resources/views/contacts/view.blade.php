@extends('layouts.main')

@section('body')
    <div class="bg-white rounded m-3 p-5" id="index">
        @include('components.nav')

        <form action="{{ route('add-contact') }}" method="post">
            @csrf
            <h2 class="text-center text-xl mb-2">Contacts with POST</h2>
            <div class="flex justify-center">
                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" name="name" type="text" placeholder="Name" value="{{ old('name') }}">
                </div>
                <div class="ml-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="useremail" name="email" type="text" placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="ml-4 flex flex-col justify-end">
                    <button type="sumbit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add
                    </button>
                </div>
            </div>
            <div class="text-sm text-red-500 mt-1">{{ $errors->any() ? $errors->first() : '' }}</div>
        </form>
        <div class="flex justify-center mt-3">
            <table class="border-collapse border-2 border-gray-500">
                <thead>
                    <tr>
                        <th class="border border-gray-400 px-4 py-2 text-gray-800">#</th>
                        <th class="border border-gray-400 px-4 py-2 text-gray-800">Name</th>
                        <th class="border border-gray-400 px-4 py-2 text-gray-800">Email</th>
                        <th class="border border-gray-400 px-4 py-2 text-gray-800">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $index => $contact)
                        <tr>
                            <td class="border border-gray-400 px-4 py-2">{{ $index }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $contact->name }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $contact->email }}</td>
                            <td class="border border-gray-400 px-4 py-2 flex gap-2">
                                <button
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded editButton"
                                    data-action="{{ route('update-contact', [$contact->id]) }}"
                                    data-name="{{ $contact->name }}" data-email="{{ $contact->email }}">
                                    Edit
                                </button>
                                <form action="{{ route('delete-contact', [$contact->id]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button type="sumbit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-white rounded m-3 p-5 hidden" id="edit">
        <form action="" method="post">
            @csrf
            @method('patch')

            <h2 class="text-center text-xl mb-2">Edit Contact</h2>
            <div class="flex justify-center">
                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="editName" name="name" type="text" placeholder="Username" value="{{ old('name') }}">
                </div>
                <div class="ml-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="editEmail" name="email" type="text" placeholder="Username" value="{{ old('email') }}">
                </div>
                <div class="ml-4 flex items-end gap-2">
                    <button id="editCancelButton" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button type="sumbit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update
                    </button>
                </div>
            </div>
            <div class="text-sm text-red-500 mt-1 mb-3">{{ $errors->any() ? $errors->first() : '' }}</div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(() => {
            $(".editButton").on('click', event => {
                event.preventDefault()

                let button = $(event.target)

                $("#editName").val(button.data('name'))
                $("#editEmail").val(button.data('email'))

                $("#edit > form").attr('action', button.data('action'))

                $("#index").hide()
                $("#edit").show()
            })

            $("#editCancelButton").on('click', event => {
                event.preventDefault()
                $("#edit").hide()
                $("#index").show()
            })
        })
    </script>
@endsection
