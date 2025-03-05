<x-app-layout>
    @section('content')
    <div class="flex justify-between items-start gap-4">
        <!-- Daftar Jurusan -->
        <div class="w-1/3 bg-white p-4  flex flex-col items-center justify-center gap-2">
            <span class="w-full text-center font-bold">Daftar Jurusan</span>
            <table class="w-100 sm:min-w-full text-sm text-left text-gray-500 border border-gray-300 shadow-md rounded-lg">
                <thead class="text-[12px] sm:text-sm text-gray-700 bg-white">
                    <tr>
                        <th class="px-2 text-center py-3 border w-[40px]">NO</th>
                        <th class="px-2 text-center py-3 border">Nama Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurusan as $index => $j)
                    <tr class="bg-white border-b cursor-pointer jurusan-row" data-id="{{ $j->id }}">
                        <td class="px-2 text-center py-4 border">{{ $index + 1 }}</td>
                        <td class="px-2 text-center py-4 border">{{ $j->nama_jurusan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <!-- Daftar Program Studi -->
        <div class="w-2/3 bg-white p-4  flex flex-col items-center justify-center gap-2">
            <span class="w-full text-center font-bold">Daftar Program Studi</span>
            <table class="w-100 sm:min-w-full text-sm text-left text-gray-500 border border-gray-300 shadow-md rounded-lg">
                <thead class="text-[12px] sm:text-sm text-gray-700 bg-white">
                    <tr>
                        <th class="px-2 text-center py-3 border w-[40px]">NO</th>
                        <th class="px-2 text-center py-3 border">Nama Program Studi</th>
                    </tr>
                </thead>
                <tbody id="programStudiTable">
                    <tr>
                        <td colspan="2" class="text-center py-4">Pilih jurusan terlebih dahulu</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    

    <script>
        $(document).ready(function() {
            $(".jurusan-row").click(function() {
                let jurusanId = $(this).data("id"); // Ambil ID jurusan yang diklik
    
                $.ajax({
                    url: "/get-program-studi/" + jurusanId, // URL endpoint untuk ambil data
                    type: "GET",
                    success: function(response) {
                        let programTable = $("#programStudiTable");
                        programTable.empty(); // Kosongkan tabel sebelum isi ulang
    
                        if (response.length === 0) {
                            programTable.append('<tr><td colspan="2" class="text-center py-4">Tidak ada program studi untuk jurusan ini</td></tr>');
                        } else {
                            $.each(response, function(index, program) {
                                programTable.append(`
                                    <tr class="bg-white border-b">
                                        <td class="px-2 text-center py-4 border">${index + 1}</td>
                                        <td class="px-2 text-center py-4 border">${program.nama_prodi}</td>
                                    </tr>
                                `);
                            });
                        }
                    },
                    error: function() {
                        alert("Gagal mengambil data program studi.");
                    }
                });
            });
        });
    </script>
    @endsection
</x-app-layout>