<div class="container">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>
                <i class="fa fa-check-circle fa-lg fa-fw"></i> Success.
            </strong>
            {{ Session::get('success') }}
        </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>
                <i class="fa fa-check-circle fa-lg fa-fw"></i> Error.
            </strong>
            {{ Session::get('error') }}
        </div>
    @endif
</div>
