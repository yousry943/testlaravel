@extends('frontend.layouts.app')

@section('title') {{app_name()}} @endsection

@section('content')

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>get All Zip</h2>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>zip Name</th>
            <th>Type</th>
            <th>Size</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>delete</th>

        </tr>
        </thead>
        <tbody>
        @foreach($zipFiles as $zip)
            <tr>
                <td>{{$zip->id}}</td>
                <td>{{$zip->zip_name}}</td>
                <td>Zip</td>
                <td>{{$zip->Sizes}}</td>
                <td>{{$zip->created_at}}</td>
                <td>{{$zip->updated_at}}</td>
                <td>
               <a href="{{url('deleteZip',$zip->id)}}"></a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

            </tr>
        @endforeach
        </tbody>
</table>

</body>
</html>



@endsection
