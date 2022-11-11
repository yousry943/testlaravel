@extends ('backend.layouts.app')





@section('content')
<section class="mb-20">
    <div class="container mx-auto flex px-5 py-10 sm:py-24 items-center justify-center flex-col">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
                Uploding zip files
            </h1>
            <p class="mb-8 leading-relaxed">
Please  uplode only zip
            </p>

            <form action="{{url('admin/uploadZipFile')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($errors->has('zip_file'))
            <div class="error">{{ $errors->first('zip_file') }}</div>
              @endif
                <input type="file" accept="zip/*" name="zip_file">
                <input type="text" accept="zip/*" name="id" value="{{$id}}" hidden>


                <button type="submit" style="color: green">Submit</button>
            </form>

        </div>
    </div>
</section>
@endsection
