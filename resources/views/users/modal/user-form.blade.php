<!-- Modal -->
<div id="userModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg px-2 py-1">
        <div class="modal-content p-6 max-h-[80vh] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            <h2 id="modalTitle" class="text-xl font-semibold mb-4"></h2>
            <form id="userForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="user_id">
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full border rounded-md p-2" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full border rounded-md p-2" required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" id="role-label" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" class="mt-1 block w-full border rounded-md p-2" required>
                        <option value="" disabled>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="alumni">Alumni</option>
                        {{-- <option value="kaprodi">Kaprodi</option> --}}
                    </select>
                </div>

                <!-- Extra Form (Tampil berdasarkan Role) -->
                <div id="extraFields" class="hidden">
                    <div id="mahasiswaFields" class="hidden">
                        <!-- Prodi -->
                        <div class="mb-4">
                            <label for="prodi" id="prodi-label" class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <select id="prodi" name="prodi" class="mt-1 block w-full border rounded-md p-2" required>
                                <option value="" disabled>Pilih Program Studi</option>
                                @foreach ($prodi as $program)
                                    <option value="{{ $program->id }}">{{ $program->nama_prodi }}</option>
                                @endforeach
                                {{-- <option value="kaprodi">Kaprodi</option> --}}
                            </select>
                        </div>

                        <!-- NIM -->
                        <div class="mb-4">
                            <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" id="nim" name="nim" class="mt-1 block w-full border rounded-md p-2">
                        </div>

                        <!-- Angkatan -->
                        <div class="mb-4">
                            <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                            <input type="text" id="angkatan" name="angkatan" class="mt-1 block w-full border rounded-md p-2">
                        </div>

                        <!-- Nomor HP -->
                        <div class="mb-4">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="mt-1 block w-full border rounded-md p-2">
                        </div>

                        <!-- Status mhs -->
                        <div class="mb-4" id="status_field" class="disabled">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full border rounded-md p-2" required>
                                <option value="" disabled>Pilih Status Kemahasiswaan</option>
                                    <option value="aktif">Aktif</option>
                                    {{-- <option value="non-aktif">Non </option> --}}
                                    <option value="lulus">Lulus</option>
                            </select>
                            <input type="hidden" name="status-alumni" value="lulus">
                        </div>
                    </div>
                    
                    <div id="alumniFields" class="hidden">
                        <div class="mb-4">
                            <label for="tahun_lulus" class="block text-sm font-medium text-gray-700">Tahun Lulus</label>
                            <input type="text" id="tahun_lulus" name="tahun_lulus" class="mt-1 block w-full border rounded-md p-2">
                        </div>
                        <div class="mb-4">
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" class="mt-1 block w-full border rounded-md p-2">
                        </div>
                        <div class="mb-4">
                            <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                            <input type="text" id="instansi" name="instansi" class="mt-1 block w-full border rounded-md p-2">
                        </div>
                        <div class="mb-4">
                            <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                            <input type="text" id="npwp" name="npwp" class="mt-1 block w-full border rounded-md p-2">
                        </div>
                        <div class="mb-4">
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" id="nik" name="nik" class="mt-1 block w-full border rounded-md p-2">
                        </div>
                    </div>

                    <div id="dosenFields" class="hidden">
                        <div class="mb-4">
                            <label for="nidn" class="block text-sm font-medium text-gray-700">NIDN</label>
                            <input type="text" id="nidn" name="nidn" class="mt-1 block w-full border rounded-md p-2">
                        </div>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full border rounded-md p-2" placeholder="••••••••">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeCreateModal" onclick="closeModal('userModal')" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                    <button type="submit" id="saveUser" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
