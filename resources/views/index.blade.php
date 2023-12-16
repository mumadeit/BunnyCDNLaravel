<x-layout>
    <div id="form">
        <h1>LinkDrop <span class="icon"><i class="ri-wifi-line"></i></span></h1>
        <p>Use this one-time link to upload your file. Once uploaded, the file will be automatically deleted.</p>


        <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="file-upload" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> Choose File
            </label>
            <input id="file-upload" name="file" type="file" style="display:none;" onchange="updateFileName(this)">
            <span id="file-name"></span>
            <button type="submit">Upload</button>
        </form>

        <p>
            @if (session()->has('success'))
                <p style="color: rgb(130, 130, 130)">{{ session()->get('success') }}</p>
            @endif
            @if (session()->has('error'))
                <p style="color: red">{{ session()->get('error') }}</p>
            @endif
        </p>
    </div>

    <script>
        function updateFileName(input) {
            var fileName = input.value.split('\\').pop();
            document.getElementById('file-name').textContent = fileName;
        }
    </script>

</x-layout>
