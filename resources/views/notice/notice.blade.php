<div class="notice">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <strong>
                <i class="fa fa-check fa-lg fa-fw"></i> Success!
            </strong>
            {{ Session::get('success') }}
        </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <strong>
                <i class="fa fa-warning fa-lg fa-fw"></i> Error!
            </strong>
            {{ Session::get('error') }}
        </div>
    @endif
</div>
