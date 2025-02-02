<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="?component=dashboard" class="list-group-item list-group-item-action active" aria-current="true">
                    Dashboard
                </a>
                <a href="?component=users" class="list-group-item list-group-item-action">Manage Users</a>
                <a href="?component=times" class="list-group-item list-group-item-action">Manage times</a>
                <a href="?disconnect=true" class="list-group-item list-group-item-action text-danger">Logout</a>
            </div>
        </div>
        <div class="col-md-9">
            <h1>Admin Dashboard</h1>
            <p>Welcome back, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">View and manage users.</p>
                            <a href="?component=users" class="btn btn-primary">Manage Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Times</h5>
                            <p class="card-text">View and manage game times.</p>
                            <a href="?component=times" class="btn btn-primary">Manage Times</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
