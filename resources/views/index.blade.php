<x-layout>
    <div id="form">
        <h1>LinkDrop <span class="icon"><i class="ri-wifi-line"></i></span></h1>
        <p>Use this one-time link to upload your file. Once uploaded, the file will be automatically deleted.</p>


        <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="">Upload A Random File</label>
            <input class="custom-file-input" name="file" required type="file">
            <button type="submit">Submit</button>
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
</x-layout>
