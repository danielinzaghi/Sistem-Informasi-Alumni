<x-app-layout>
    @section('content')
    @section('main_folder', 'Dosen')
    @section('main_folder-link', route('admin.dosen.index'))
    @section('sub_folder', 'Edit Dosen')
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Data Dosen</h2>
        
            <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
        
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-4">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
        
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ $dosen->nama }}" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>

                <div class="mb-5">
                    <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                    <select @readonly($user->roles->first()->name == 'admin') name="role_id" id="role_id" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required>
                        <option value="" disabled>Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->roles->first()->id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="text" step="0.01" name="email" id="email" value="{{ $user->email }}" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>