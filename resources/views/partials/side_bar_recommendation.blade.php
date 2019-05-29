<div class="card">
    <div class="card-header">People to follow</div>
    @include('partials.users_list',['users'=>$recommendation['users']])
</div>
<div class="card">
    <div class="card-header">Reviews to read</div>
    @include('partials.reviews_list',['reviews'=>$recommendation['reviews']])
</div>