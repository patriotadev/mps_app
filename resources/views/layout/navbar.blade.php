<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">My Programming Space</a>
        <div>
            <img src="" alt="">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/forum">Forum</a>

                @if (!Session::has('hasLogin'))
                <a class="nav-item nav-link" href="/signin">Sign In</a>
                @endif

                @if (Session::has('hasLogin'))
                <a class="nav-item nav-link" href="/signout">Sign Out</a>
                @endif
                
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar-brand {
        text-shadow: 2px 2px 2px lightgray;
    }
</style>