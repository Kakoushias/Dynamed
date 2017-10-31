@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <hr>

                <div>
                <form action="{{route('import')}}" method="POST">
                    <div>
                        <label for="file">Choose .xml file to upload</label>
                        <input type="file" id="file" name="CCD">
                    </div>
                    <hr>
                    <div>
                    <button>Submit</button>
                    </div>
                </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
