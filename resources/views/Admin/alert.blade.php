@if(session()->has('success'))
    <div>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{ session()->get('success')  }}</h4>

            <hr>
        </div>
    </div>
@endif
